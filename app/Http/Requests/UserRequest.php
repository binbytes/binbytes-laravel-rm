<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'avatar' => 'image',
            'email' => 'required|email|unique:users',
            'username' => 'required|min:2|unique:users',
            'password' => 'required|min:3',
            'dob' => 'required|date',
            'address' => 'required',
            'mobile_no' => 'required'
        ];
    }
}
