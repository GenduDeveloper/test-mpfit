<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->resource->id,
            'created_at'  => $this->resource->created_at,
            'full_name'   => $this->resource->full_name,
            'status'      => $this->resource->status,
            'total_price' => $this->resource->total_price
        ];
    }
}
