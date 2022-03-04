<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'identify' => $this->identify,
            'total' => $this->total,
            'total_discount' => $this->total_discount,
            'total_change' => $this->total_change,
            'total_paid' => $this->total_paid,
            'total_change' => $this->total_change,
            'shipping' => $this->shipping,
            'status' => $this->status,
            'status_label' => $this->statusOptions[$this->status],
            'form_payment' => new FormPaymentResource($this->formPayment),
            'address' => $this->address,
            'message' => $this->comment,
            'create' => Carbon::make($this->created_at)->format('Y-m-d H:i:s'),
            'date_br' => Carbon::make($this->created_at)->format('d/m/Y'),
            'products' => ProductResource::collection($this->products),
            'client' => new ClientResource($this->client),
            'table' => new TableResource($this->table),
            'deliveryman' => new UserResource($this->deliverymen),
            'company' => new TenantResource($this->tenant),
            'evaluations' => EvaluationResource::collection($this->evaluations)
        ];
    }
}
