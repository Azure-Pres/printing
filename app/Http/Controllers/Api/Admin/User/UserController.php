<?php

namespace App\Http\Controllers\Api\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Api\Admin\User\UserResource;
use App\Models\User;


class UserController extends Controller
{
    public function index(Request $request)
    {
        try{
            $input         = $request->all();
            $users         = User::getApiUserModel($input);
            $response      = UserResource::collection($users);

            return response([
                'success'       => true,
                'message'       => 'Users fetched successfully.',
                'users'        => $response
            ],200);
        }catch(Exception $e){
            return response([
                'success'  => false,
                'message'  => 'Something went wrong.'
            ], 200);
        }
    }

    public function show($id)
    {
        try{    
            $id   = decrypt($id);
            $user = User::find($id);

            if(!$user){
                return response([
                    'success' => false,
                    'message' => 'User not found.'
                ], 200);
            }

            $response = new UserResource($user);
            
            return response([
                'success'       => true,
                'message'       => 'User fetched successfully.',
                'user'          =>  $response
            ], 200);

        }catch(Exception $e){
            return response([
                'success' => false,
                'message' => 'Something went wrong.'
            ], 200);
        }
    }
}
