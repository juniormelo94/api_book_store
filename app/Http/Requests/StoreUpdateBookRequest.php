<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class StoreUpdateBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'isbn' => 'integer',
            'value' => 'numeric',
        ];
    }

    /**
     * Overriding the event validator for custom error response.
     *
     * @param  \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     *
     */
    public function failedValidation(Validator $validator)
    {
       throw new HttpResponseException(response()->json($validator->errors(), 422)); 
    }
}
