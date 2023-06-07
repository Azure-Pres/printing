<?php

namespace App\Http\Resources\Api\Verification;

use Illuminate\Http\Resources\Json\JsonResource;

class VerificationResource extends JsonResource
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
            'raw_id'                => $this->id,
            'client'                => $this->getClient->name??'NA',
            'message'               => $this->message??'NA',
            'code_data'             => $this->code_data??'NA',
            'status'                => $this->status??'NA',
            'created_at'            => date('M d, h:i A',strtotime($this->created_at)),
            'updated_at'            => date('M d, h:i A',strtotime($this->updated_at)),
        ];
    }
}
