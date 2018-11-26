<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalaryRequest extends FormRequest
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
            'base_salary' => 'numeric|required',
            'bonus' => 'numeric',
            'penalty' => 'numeric',
            'payment_method'=> 'nullable',
            'paid_note' => 'nullable',
            'general_note' => 'nullable'
        ];
    }
}
