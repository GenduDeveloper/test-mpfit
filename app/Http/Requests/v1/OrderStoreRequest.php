<?php

namespace App\Http\Requests\v1;

use App\DTO\OrderStoreData;
use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'customer_name'       => ['required', 'string', 'min:2'],
            'customer_surname'    => ['required', 'string', 'min:2'],
            'customer_patronymic' => ['required', 'string', 'min:2'],
            'comment'             => ['nullable', 'string'],
            'product_id'          => ['required', 'integer', 'exists:products,id'],
            'product_quantity'    => ['required', 'integer', 'min:1']
        ];
    }

    public function getValidatedOrderStoreData(): OrderStoreData
    {
        return OrderStoreData::fromArray($this->validated());
    }
}
