<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'discountPercentag' => $this->discountPercentag,
            'rating' => $this->rating,
            'stock' => $this->stock,
            'brand' => $this->brand,
            'category' => $this->category,
            'thumbnail' => $this->thumbnail,
            'images' => $this->images->pluck('link_image'),
        ];
    }
}
