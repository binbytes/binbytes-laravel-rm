<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
            'user_id' => 'nullable|exists:users,id', // If null, it is own by company
            'name' => [
                'required',
                Rule::unique('accounts')->ignore($this->id),
            ],
            'bank_name' => 'required',
            'account_number' => 'required',
            'name_on_account' => 'required',
            'branch_of' => 'nullable',
            'address' =>'nullable',
            'ifsc_code' => 'nullable',
            'contact_number' => 'nullable',
            'statement_starting_line' => 'required|numeric',
        ];
    }
}
