<?php

namespace App\Http\Resources\Api\JobCard;

use Illuminate\Http\Resources\Json\JsonResource;

class JobCardResource extends JsonResource
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
            'id'                    => encrypt($this->id),
            'raw_id'                => $this->id,
            'client'                => $this->getBatch->getClient->name??'NA',
            'job_card'              => $this->job_card_id??'NA',
            'batch'                 => $this->getBatch->batch_code??'NA',
            'machine'               => $this->machine??'NA',
            'status'                => $this->print_status??'NA',
            'created_at'            => getDateWithFormat($this->created_at),
            'updated_at'            => getDateWithFormat($this->updated_at),
        ];
    }
}
