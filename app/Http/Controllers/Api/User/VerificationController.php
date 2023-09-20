<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Verification\VerificationResource;
use App\Models\Batch;
use App\Models\Code;
use App\Models\OnlineHistory;
use App\Models\User;
use App\Models\Verification;
use Auth;
use DB;
use Illuminate\Http\Request;
use Validator;
use Exception;

class VerificationController extends Controller
{
    public function index(Request $request)
    {
        $input = $request->all();
        $verifications   = Verification::getApiVerificationModel($input);
        $response   = VerificationResource::collection($verifications['data']);

        return response([
            'success'   => true,
            'message'   => 'Verifications fetched successfully.',
            'verifications'  => $response,
            'total'          => $verifications['total']
        ], 200);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $rules = [
            'client_id'   =>  'required|exists:users,id',
            'batch_id'    =>  'required|exists:batches,id',
            'code_data'   =>  'required'
        ];

        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response([
                'success'   => false,
                'message'   => 'Invalid request'
            ], 400);
        } else {
            $client = User::find($input['client_id']);
            $batch = Batch::find($input['batch_id']);
            $input_codes = explode($input['delimiter'], $input['code_data']);

            $request_verified = true;
            $data = [];
            $code_ids = [];

            $query = "
            SELECT id, code_data, client_id, batch_id
            FROM codes
            WHERE client_id = ? 
            AND batch_id  = ? 
            AND (
                JSON_UNQUOTE(JSON_EXTRACT(code_data, '$.upi_qr_url')) IN (" . implode(', ', array_fill(0, count($input_codes), '?')) . ")
                OR JSON_UNQUOTE(JSON_EXTRACT(code_data, '$.upistring')) IN (" . implode(', ', array_fill(0, count($input_codes), '?')) . ")
                OR JSON_UNQUOTE(JSON_EXTRACT(code_data, '$.intent_string')) IN (" . implode(', ', array_fill(0, count($input_codes), '?')) . ")
                OR JSON_UNQUOTE(JSON_EXTRACT(code_data, '$.qr_text')) IN (" . implode(', ', array_fill(0, count($input_codes), '?')) . ")
                )
            ";
            $bindings = array_merge([$input['client_id'], $input['batch_id']], $input_codes, $input_codes, $input_codes, $input_codes);
            $matched_codes = DB::select($query, $bindings);

            $jobcard = $batch->getJobcard;

            foreach ($input_codes as $input_code) {
                $code =$this->getCodesFromMatched($matched_codes, $input_code);

                $create = new Verification;
                $create->code_data = $input_code;
                $create->client_id = $input['client_id'];
                $create->scanned_by = Auth::id();
                $create->save();

                $message = 'Verified';
                $status = 'Success';

                if (!$code) {
                    $message   = 'Invalid or broken code.';
                    $status    = 'Failed';
                } else {

                    if ($batch->status!='Active') {
                        $message   = 'Batch not active.';
                        $status    = 'Failed';
                    }
                    
                    if (!$jobcard) {
                        $message   = 'Job card not assigned.';
                        $status    = 'Failed';
                    }else{
                        if ($jobcard->status!='Active') {
                            $message   = 'Jobcard inactive.';
                            $status    = 'Failed';
                        }
                        
                        $count = Verification::where('code_id',$code->id)->where('client_id',$client->id)->count();

                        if ($count>=$jobcard->allowed_copies) {
                            $message   = 'Maximum copy exceeded.';
                            $status    = 'Failed';
                        }

                        if ($count==$jobcard->allowed_copies-1) {
                            array_push($code_ids, $code->id);
                        }
                    }
                }

                $create->message   = $message;
                $create->status    = $status;

                if ($status=='Success') {
                    $create->code_id   = $code->id;
                }else{
                    $request_verified = false;
                }

                $create->save();

                array_push($data, [
                    'code_data' => $input_code,
                    'status'    => $status,
                    'message'   => $message
                ]);
            }

            if ($request_verified) {
                $update_first_verification = Code::whereIn('id',$code_ids)->update([
                    'first_verification_status' => 'Success'
                ]);
            }

            $online_history = OnlineHistory::create([
                'history' => json_encode($data)
            ]);

            return response([
                'success'   => true,
                'message'   => 'Success',
                'data'      => $data,
                'verification_status' => $request_verified
            ], 200);
        }
    }

    public function getCodesFromMatched($matched_codes, $input_code)
    {
        $code = null;

        foreach ($matched_codes as $matched_code) {
            $codeDataArray = json_decode($matched_code->code_data, true);
            if (
                (isset($codeDataArray['upi_qr_url']) && $codeDataArray['upi_qr_url'] == $input_code) ||
                (isset($codeDataArray['upistring']) && $codeDataArray['upistring'] == $input_code) ||
                (isset($codeDataArray['qr_text']) && $codeDataArray['qr_text'] == $input_code) ||
                (isset($codeDataArray['intent_string']) && $codeDataArray['intent_string'] == $input_code)
            ) {
                $code = $matched_code;
                break;
            }
        }

        return $code;
    }
}