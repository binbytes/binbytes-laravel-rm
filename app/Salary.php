<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    public $dates = [
        'paid_for'
    ];

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
    public function scopePaidForMonth($query, $date = null)
    {
        if($date == null) $date = today()->format('Y-m-d');

        return $query->where('paid_for', $date);
    }

    /**
     * Suggested name of PDF file
     *
     * @return string
     */
    public function paySlipFileName()
    {
        return "payslip{$this->user_id}-{$this->paid_for->format('F-Y')}.pdf";
    }

    /**
     * Get binary of PDF
     *
     * @return \Barryvdh\DomPDF\PDF
     */
    public function paySlipPDF()
    {
        return \PDF::loadView('letter.payslip', [
            'salary' => $this
        ]);
    }
}
