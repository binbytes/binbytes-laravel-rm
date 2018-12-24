<?php

namespace App\Http\Requests;

use App\Rules\FutureDate;
use Illuminate\Foundation\Http\FormRequest;

class LeaveRequest extends FormRequest
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
            'subject' => 'required',
            'description' => 'required',
            'start_date' => [
                'required', 'date',
                new FutureDate,
            ],
            'end_date' => [
                'nullable', 'date',
                new FutureDate,
            ],
            'start_date_partial_hours' => 'nullable|numeric|max:10',
            'end_date_partial_hours' => 'nullable|numeric|max:10',
        ];
    }
}
