<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $fillable = [
        'user_id', 'base_salary', 'paid_amount', 'paid_for', 'pf', 'tds', 'bonus', 'penalty', 'payment_method',
        'paid_note', 'general_note'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get records salary paid for month
     *
     * @param $query
     * @param null $month
     * @return mixed
     */
    public function scopePaidForMonth($query, $month = null)
    {
        if($month == null) $month = today()->month;

        return $query->whereMonth('paid_for', $month);
    }

    public function paySlipFileName()
    {
        return "payslip{$this->user_id}-{$this->paid_for->format('F Y')}.pdf";
    }
}
