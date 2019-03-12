<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    public $dates = [
        'date',
    ];

    protected $fillable = [
        'account_id', 'sequence_number', 'date', 'description', 'reference', 'credit_amount', 'debit_amount',
        'closing_balance', 'type', 'note', 'invoice', 'transactional_type', 'transactional_id',
    ];

    protected $casts = [
        'credit_amount' => 'float',
        'debit_amount' => 'float',
        'closing_balance' => 'float',
    ];

    public function isCredit()
    {
        return $this->credit_amount > 0;
    }

    public function isDebit()
    {
        return $this->debit_amount > 0;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function transactionType()
    {
        return $this->belongsTo(TransactionType::class, 'type');
    }

    public function scopeWithInvoice($query)
    {
        return $query->where('invoice', '<>', null);
    }

    public function scopeWithoutInvoice($query)
    {
        return $query->where('invoice', null);
    }
}
