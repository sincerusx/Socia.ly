<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                'username' => 'required|string|max:255|unique:users',
                'email'    => 'required|string|email|max:255|unique:users',
                'phone'    => 'required|string|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
                'username.required' => 'Please enter a valid :attribute',
                'username.string'   => 'Please enter a valid :attribute',
                'username.max'      => 'Please enter a valid :attribute',
                'username.unique'   => 'This :attribute is already taken',

                'email.required' => 'Please enter a valid :attribute',
                'email.string'   => 'Please enter a valid :attribute',
                'email.max'      => 'Please enter a valid :attribute',
                'email.unique'   => 'This :attribute is already taken',

                'phone.required' => 'Please enter a valid :attribute',
                'phone.string'   => 'Please enter a valid :attribute',
                'phone.max'      => 'Please enter a valid :attribute',
                'phone.unique'   => 'This :attribute is already taken',

                'password.required' => 'Please enter a valid :attribute',
                'password.string'   => 'Please enter a valid :attribute',
                'password.min'      => 'Please enter a valid :attribute',
        ];
    }
}
