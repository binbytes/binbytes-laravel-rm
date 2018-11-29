<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'user_id', 'name', 'bank_name', 'account_number', 'name_on_account', 'branch_of', 'address',
        'ifsc_code', 'contact_number', 'statement_starting_line'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

