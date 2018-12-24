<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'user_id', 'name', 'bank_name', 'account_number', 'name_on_account', 'branch_of', 'address',
        'ifsc_code', 'contact_number', 'statement_starting_line',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'first_name' => config('rm.company.name'),
            'username' => config('rm.company.name'),
            'email' => config('rm.company.email'),
        ]);
    }

    /**
     * Set any specific reader type for any specific bank.
     * @return null|string
     */
    public function statementReaderType()
    {
        return $this->bank_name === 'SBI' ? \Maatwebsite\Excel\Excel::CSV : null;
    }

    /**
     * Set any specific reader type for any specific bank.
     * @return null|string
     */
    public function customDelimiter()
    {
        return $this->bank_name === 'SBI' ? "\t" : null;
    }
}
