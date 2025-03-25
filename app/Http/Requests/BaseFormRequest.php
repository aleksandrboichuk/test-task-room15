<?php

namespace App\Http\Requests;

use App\Helpers\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

abstract class BaseFormRequest extends FormRequest
{
    abstract public function rules(): array;

    protected function failedValidation(Validator $validator)
    {
        if($this->wantsJson()){
            $response = Response::validationError($validator->errors());

            throw new ValidationException($validator, $response);
        }

        $exception = $validator->getException();

        throw new $exception($validator);
    }
}
