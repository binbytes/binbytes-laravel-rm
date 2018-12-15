<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        return array_merge([
            'first_name' => 'required',
            'last_name' => 'required',
            'avatar' => 'image',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->id)
            ],
            'personal_email' => [
                'nullable',
                'email',
                Rule::unique('users')->ignore($this->id)
            ],
            'username' => [
                'required',
                'min:2',
                Rule::unique('users')->ignore($this->id)
            ],
            'dob' => 'nullable|date',
            'designation_id' => 'required',
            'address' => 'required',
            'mobile_no' => 'required',
            'joining_date' => 'nullable|date', //required
            'leaving_date' => 'nullable|date',
            'is_active' => 'boolean',
            'use_icon_sidebar' => 'boolean',
            'role' => 'required',
            'exclude_from_salary' => 'boolean',
            'exclude_from_attendance' => 'boolean',
            'weekly_hours_credit' => 'nullable|numeric|max:60', // Assuming :)
            'base_salary' => 'nullable|numeric'
        ], $this->method() == 'POST' ? [
            'password' => 'required|min:3',
        ] : []);
    }
}
