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
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'slug' => $this->slug,
            'price' => [
                'full' => $this->price,
                'discounted' => $this->discounted_price, 
            ],
            'discount' => [
                'type' => $this->discount->type,
                'amount' => $this->discount->discount,
            ],
            'images' => $this->images->pluck('path'),
        ];
    }

}
