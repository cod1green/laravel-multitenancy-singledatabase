<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProviderResource extends JsonResource
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
            "identify" => $this->uuid,          
            "name" => $this->name,
            "document" => $this->document,
            "email" => $this->email,
            "phone" => $this->phone,
            "about" => $this->about,
            "address" => $this->address,
            "tenant_id" => new TenantResource($this->tenant),
        ];
    }
}
