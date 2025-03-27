<?php

namespace App\Http\Requests\Resource\Product;

use App\Http\Requests\BaseFormRequest;

class ProductStoreRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'min:3',
                'max:75',
                'unique:products,title',
            ],
            'price' => [
                'required',
                'numeric',
                'min:0'
            ],
            'currency_id' => [
                'required',
                'integer',
                'exists:currencies,id',
            ],
        ];
    }
}
