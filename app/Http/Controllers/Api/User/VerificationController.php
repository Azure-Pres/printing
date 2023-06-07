<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Verification\VerificationResource;
use App\Models\Code;
use App\Models\User;
use App\Models\Verification;
use Illuminate\Http\Request;
use Validator;
use Auth;

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
            $input_codes = explode(',', $input['code_data']);

            foreach ($input_codes as $input_code) {

                $create = new Verification;
                $create->code_data = $input_code;
                $create->client_id = $input['client_id'];
                $create->scanned_by = Auth::id();
                $create->save();

                $code = Code::where('client_id',$input['client_id'])->where(function($query) use ($input_code){
                    $query->whereJsonContains('code_data', ['upi_qr_url'=>$input_code])->orWhereJsonContains('code_data', ['upistring'=>$input_code])->orWhereJsonContains('code_data', ['intent_string'=>$input_code])->orWhereJsonContains('code_data', ['qr_text'=>$input_code]);
                })->first();

                $verified = true;

                if (!$code) {
                    $create->message   = 'Invalid or broken code.';
                    $create->status    = 'Failed';
                    $create->save();
                    $verified = false;
                }else{
                    if (!$code->getBatch) {
                        $create->message   = 'Batch not assigned.';
                        $create->status    = 'Failed';
                        $create->save();
                        $verified = false;
                    }else{

                        $batch = $code->getBatch;

                        if ($batch->status!='Active') {
                            $create->message   = 'Batch not active.';
                            $create->status    = 'Failed';
                            $create->save();
                            $verified = false;
                        }

                        if (!$code->getBatch->getJobcard) {
                            $create->message   = 'Job card not assigned.';
                            $create->status    = 'Failed';
                            $create->save();
                            $verified = false;
                        }else{
                            $jobcard = $code->getBatch->getJobcard;

                            if ($jobcard->print_status!='Printed') {
                                $create->message   = 'Job card not printed.';
                                $create->status    = 'Failed';
                                $create->save();
                                $verified = false;
                            }

                            if ($jobcard->status!='Active') {
                                $create->message   = 'Job card not active.';
                                $create->status    = 'Failed';
                                $create->save();
                                $verified = false;
                            }

                            $count = Verification::where('code_id',$code->id)->where('client_id',$client->id)->count();

                            if ($count>=$jobcard->allowed_copies) {
                                $create->message   = 'Maximum copy exceeded.';
                                $create->status    = 'Failed';
                                $create->save();
                                $verified = false;
                            }

                        }
                    }                    
                }

                if ($verified) {
                    $create->message   = 'Verified successfully.';
                    $create->status    = 'Success';
                    $create->code_id   = $code->id;
                    $create->save();
                }
            }

            return response([
                'success'   => true,
                'message'   => 'Success'
            ], 200);
        }
    }
}
