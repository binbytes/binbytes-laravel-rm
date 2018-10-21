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
            'personal_email' => 'nullable|email|unique:users',
            'username' => 'required|min:2|unique:users',
            'password' => 'required|min:3',
            'dob' => 'date',
            'address' => 'required',
            'mobile_no' => 'required',
            'joining_date' => 'required|date',
            'leaving_date' => 'date',
            'is_active' => 'boolean',
            'weekly_hours_credit' => 'nullable|numeric|max:60', // Assuming :)
            'base_salary' => 'nullable|numeric'
        ];
    }
}
