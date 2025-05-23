<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductDetailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->resource->id,
            'name'        => $this->resource->name,
            'category_id' => $this->resource->category_id,
            'description' => $this->resource->description ?? '',
            'price'       => $this->resource->price
        ];
    }
}
