<?php

namespace App\Http\Resources\Api\Auth;

use App\Http\Resources\Api\Permission\PermissionResource;
use App\Models\Permission;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $delete_recent_tokens = $this->tokens()->delete();
        $permissions = Permission::where('user_id',$this->id)->get();
        $permissions_response  = PermissionResource::collection($permissions);

        $results = [
            'success' => true,
            'message' =>'Login Successful.',
            'user' => [
                'name'       => $this->name,
                'email'      => $this->email,
                'phone'      => $this->phone
            ],
            'permissions'     => $permissions_response,
            'machines'        => json_decode($this->machines),
            'token'           => $this->createToken('app-token')->plainTextToken
        ];

        return $results;
    }
}
