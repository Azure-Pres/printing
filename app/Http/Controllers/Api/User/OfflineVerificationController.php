<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Verification\VerificationResource;
use App\Models\Batch;
use App\Models\Code;
use App\Models\OfflineHistory;
use App\Models\OfflineVerification;
use App\Models\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use Validator;

class OfflineVerificationController extends Controller
{
    public function index(Request $request)
    {
        $input = $request->all();
        $verifications   = OfflineVerification::getApiVerificationModel($input);
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
            'batch_id'   =>  'required|exists:batches,id',
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

            foreach ($input_codes as $input_code) {

                $create = new OfflineVerification;
                $create->code_data = $input_code;
                $create->client_id = $input['client_id'];
                $create->scanned_by = Auth::id();
                $create->save();

                $query = "
                SELECT *
                FROM codes
                WHERE client_id = '{$input['client_id']}'
                AND batch_id = '{$input['batch_id']}' 
                AND (
                    JSON_UNQUOTE(JSON_VALUE (code_data, '$.upi_qr_url')) = '{$input_code}'
                    OR JSON_UNQUOTE(JSON_VALUE(code_data, '$.upistring')) = '{$input_code}'
                    OR JSON_UNQUOTE(JSON_VALUE(code_data, '$.intent_string')) = '{$input_code}'
                    OR JSON_UNQUOTE(JSON_VALUE(code_data, '$.qr_text')) = '{$input_code}'
                    )
                AND second_verification_status IS NULL
                AND first_verification_status = 'Success'
                LIMIT 1;
                ";

                $code = DB::selectOne($query);

                $message = 'Verified';
                $status = 'Success';

                if (!$code) {
                    $message   = 'Invalid or broken code.';
                    $status    = 'Failed';
                }else{
                    $jobcard = $batch->getJobcard;
                    
                    $count = OfflineVerification::where('code_id',$code->id)->where('client_id',$client->id)->count();

                    if ($count>=$jobcard->allowed_copies) {
                        $message   = 'Maximum copy exceeded.';
                        $status    = 'Failed';
                    }

                    if ($count==$jobcard->allowed_copies-1) {
                        array_push($code_ids, $code->id);
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
                $update_second_verification = Code::whereIn('id',$code_ids)->update([
                    'second_verification_status' => 'Success'
                ]);
            }

            $online_history = OfflineHistory::create([
                'history' => json_encode($data)
            ]);

            if (!$request_verified && env('FAILED_OFFLINE_VERIFICATION_IP')!='') {

                try{
                    $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
                    $ip = env('FAILED_OFFLINE_VERIFICATION_IP');
                    $port = env('FAILED_OFFLINE_VERIFICATION_PORT');

                    if ($socket === false || !socket_connect($socket, $ip, $port)) {
                    } else {
                        $sock_data = env('FAILED_OFFLINE_VERIFICATION_STRING');
                        socket_write($socket, $sock_data, strlen($sock_data));
                        socket_close($socket);
                    }
                }catch(Exception $e){}

            }

            return response([
                'success'   => true,
                'message'   => 'Success',
                'data'      => $data,
                'verification_status' => $request_verified
            ], 200);
        }
    }
}
