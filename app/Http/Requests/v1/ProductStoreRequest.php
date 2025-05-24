<?php

namespace App\Http\Requests\v1;

use App\DTO\ProductStoreData;
use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'        => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'description' => ['nullable', 'string', 'max:600'],
            'price'       => ['required', 'decimal:2']
        ];
    }

    public function getValidatedProductStoreData(): ProductStoreData
    {
        return ProductStoreData::fromArray($this->validated());
    }
}
