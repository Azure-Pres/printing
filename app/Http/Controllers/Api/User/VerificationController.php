<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Verification\VerificationResource;
use App\Models\Code;
use App\Models\OnlineHistory;
use App\Models\User;
use App\Models\Verification;
use Auth;
use Illuminate\Http\Request;
use Validator;

class VerificationController extends Controller
{
    public function index(Request $request)
    {
        $input = $request->all();
        $verifications   = Verification::getApiVerificationModel($input);
        $response   = VerificationResource::collection($verifications);

        return response([
            'success'   => true,
            'message'   => 'Verifications fetched successfully.',
            'verifications'  => $response
        ], 200);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $rules = [
            'client_id'   =>  'required|exists:users,id',
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
            $input_codes = explode($input['delimiter'], $input['code_data']);

            $request_verified = true;
            $data = [];
            $code_ids = [];

            foreach ($input_codes as $input_code) {

                $create = new Verification;
                $create->code_data = $input_code;
                $create->client_id = $input['client_id'];
                $create->scanned_by = Auth::id();
                $create->save();

                $code = Code::where('client_id',$input['client_id'])->where(function($query) use ($input_code){
                    $query->whereJsonContains('code_data', ['upi_qr_url'=>$input_code])->orWhereJsonContains('code_data', ['upistring'=>$input_code])->orWhereJsonContains('code_data', ['intent_string'=>$input_code])->orWhereJsonContains('code_data', ['qr_text'=>$input_code]);
                })->first();

                $message = 'Verified';
                $status = 'Success';

                if (!$code) {
                    $message   = 'Invalid or broken code.';
                    $status    = 'Failed';
                }else{
                    if (!$code->getBatch) {
                        $message   = 'Batch not assigned.';
                        $status    = 'Failed';
                    }else{
                        $batch = $code->getBatch;
                        if ($batch->status!='Active') {
                            $message   = 'Batch not active.';
                            $status    = 'Failed';
                        }
                        if (!$code->getBatch->getJobcard) {
                            $message   = 'Job card not assigned.';
                            $status    = 'Failed';
                        }else{
                            $jobcard = $code->getBatch->getJobcard;
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
}
