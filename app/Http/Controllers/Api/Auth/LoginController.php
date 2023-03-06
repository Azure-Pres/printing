<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Auth\LoginResource;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use Exception;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->rules = [
            'email'      => getRule('email',true).'|exists:users',
            'password'   => getRule('',true)
        ];
    }

    public function index(Request $request)
    {
        try{
            $input = $request->all();
            $validator = Validator::make($input, $this->rules);

            if($validator->fails()) {
                return response([
                    'success'   => false,
                    'message'   => 'Invalid given data.',
                    'errors'    => $validator->errors()
                ], 200);
            }else{

                $user= User::where('email', $request->email)->first();

                if (!Hash::check($request->password, $user->password)) {
                    $response = [
                        'success' => false,
                        'message' => 'Invalid credentials.',
                        'errors'  => [
                            'password' =>['Invalid credentials.']
                        ]
                    ];
                    return response($response, 200);
                }

                if($user->status == 'Inactive'){
                    return response([
                        'success'=> false,
                        'message'=> 'Your account is Inactive. Please contact to Administrator.',
                    ],200);
                }

                if($user->status == 'Blocked'){
                    return response([
                        'success'=> false,
                        'message'=> 'Your account is Blocked. Please contact to Administrator.',
                    ],200);
                }

                return response(new LoginResource($user), 200);
            }
        }catch(Exception $e){
            return response([
                'success'  => false,
                'message'  => 'Something went wrong.'
            ], 200);
        }
    }
}
