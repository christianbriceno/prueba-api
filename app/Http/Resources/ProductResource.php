<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($request->isMethod("DELETE")) {
            return [
                'status' => 200
            ];
        }
        return [
            'type' => 'Products',
            'id' => (string) $this->resource->getRouteKey(),
            'attributes' => [
                'name' => $this->resource->name,
                'price' => (float) $this->resource->price
            ],
            'links' => [
                'self' => route('products.show', $this->resource->id)
            ]
        ];
    }

    public function toResponse($request)
    {
        return parent::toResponse($request)->withHeaders([
            'location' => route('products.show', $this->resource)
        ]);
    }
}
