<?php

namespace App\Http\Requests\Resource;

use App\Http\Requests\BaseFormRequest;

class ProductUpdateRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'min:3',
                'max:75',
                'unique:products,title,' . $this->route('product'),
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
