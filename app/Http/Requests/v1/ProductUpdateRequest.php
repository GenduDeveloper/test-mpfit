<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'        => ['string', 'max:255'],
            'category_id' => ['integer', 'exists:categories,id'],
            'description' => ['string', 'max:600'],
            'price'       => ['decimal:2']
        ];
    }
}
