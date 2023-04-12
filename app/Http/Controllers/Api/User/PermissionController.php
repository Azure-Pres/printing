<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Api\Permission\PermissionResource;
use App\Models\Permission;

class PermissionController extends Controller
{
    public function index(Request $request){
        try{
            $input       = $request->all();
            $permissions = Permission::getApiPermissionModel($input);
            $response    = PermissionResource::collection($permissions);

            return response([
                'success'   => true,
                'message'   => 'Permissions fetched successfully.',
                'permissions' => $response
            ], 200);
        }catch(Exception $e){
            return response([
                'success' => false,
                'message' => 'Something went wrong.'
            ], 200);
        }
    }
}
