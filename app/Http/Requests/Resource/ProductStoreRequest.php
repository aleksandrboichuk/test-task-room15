<?php

namespace App\Http\Requests\Resource;

use App\Http\Requests\BaseFormRequest;
use Illuminate\Contracts\Validation\ValidationRule;

class ProductStoreRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'min:3',
                'max:75'
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
