<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CouponResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'flag' => $this->url,
            'description' => $this->description,
            'identify' => $this->uuid,
            'discount' => $this->discount,
            'discount_mode' => $this->discount_mode,
            'limit' => $this->limit,
            'limit_mode' => $this->limit_mode,
            'start_validity' => $this->start_validity,
            'end_validity' => $this->end_validity,
            'active' => $this->active,            
        ];
    }
}
