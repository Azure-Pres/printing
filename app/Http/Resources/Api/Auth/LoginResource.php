<?php

namespace App\Http\Resources\Api\Auth;

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
        
        $results = [
            'success' => true,
            'message' =>'Login Successful.',
            'user' => [
                'name'       => $this->name,
                'email'      => $this->email,
                'phone'      => $this->phone
            ],
            'token'           => $this->createToken('app-token')->plainTextToken
        ];

        return $results;
    }
}
