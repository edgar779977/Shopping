<?php

namespace App\Http\Requests;

use App\Http\Resources\ErrorResource;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;


class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize():bool
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
            'first_name' => 'required|min:5',
            'last_name' => 'required|min:5',
            'email' => "required|email:rfc,dns|unique:users,email",
            'password' => 'required|min:8',
            'passwordConfirm' => 'required|same:password'
        ];
    }

    public function messages()
    {
        return [

            'last_name.required' => 'The filed is required',
//            'last_name.required' => 'The Last name must be minimum 5 chars ',
//            'last_name' => 'required|alpha|between:2,40',
            'unique' => "The email Address already exists",
//            'password' => 'required|min:8',
//            'passwordConfirm' => 'required|same:password'
        ];
    }
}
