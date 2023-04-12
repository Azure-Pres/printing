<?php

namespace App\Http\Resources\Api\Admin\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'         => encrypt($this->id),
            'name'       => $this->name,
            'email'      => $this->phone,
            'address'    => $this->address,
            'city'       => $this->city,
            'state'      => $this->state,
            'zipcode'    => $this->zipcode,
            'status'     => $this->status,
            'machines'   => json_decode($this->machines),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
