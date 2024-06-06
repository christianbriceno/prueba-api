<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'type' => 'Orders',
            'id' => (string) $this->resource->getRouteKey(),
            'attributes' => [
                'user_id' => $this->resource->user_id,
            ],
            'links' => [
                'self' => route('orders.show', $this->resource->id)
            ]
        ];
    }
}
