<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
            'account_id' => 'required|exists:accounts,id',
            'sequence_number' => 'required|numeric',
            'date' => 'required|date',
            'description' => 'nullable',
            'reference' =>'nullable',
            'credit_amount' => 'nullable|numeric',
            'debit_amount' => 'nullable|numeric',
            'closing_balance' => 'required|numeric',
            'type' => 'nullable',
            'note' => 'nullable',
            'invoice' => 'nullable|file',
        ];
    }
}
