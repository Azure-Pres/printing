<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Api\Permission\PermissionResource;
use App\Models\Permission;
use Auth;

class PermissionController extends Controller
{
    public function index(Request $request){
        try{
            $input       = $request->all();
            $permissions = Permission::where('user_id',Auth::id())->get();
            $response    = PermissionResource::collection($permissions);

            return response([
                'success'       => true,
                'message'       => 'Permissions fetched successfully.',
                'permissions'   => $response,
                'machines'      => json_decode(Auth::user()->machines)
            ], 200);
        }catch(Exception $e){
            return response([
                'success' => false,
                'message' => 'Something went wrong.'
            ], 200);
        }
    }
}
