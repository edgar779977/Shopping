<?php

namespace App\Http\Requests;

use App\Http\Resources\ErrorResource;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' =>'required',
            'type' =>'required',
            'description' =>'required',
            'price' =>'required|integer',
        ];
    }

    /**
     * @param Validator $validator
     * @return ErrorResource
     */
    protected function failedValidation(Validator $validator): ErrorResource
    {
        return new ErrorResource(['message' => 'something went wrong','status' => 422]);
    }
}
