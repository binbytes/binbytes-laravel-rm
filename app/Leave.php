<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    public $dates = [
        'start_date', 'end_date'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'subject', 'description', 'start_date', 'start_date_partial_hours', 'end_date', 'end_date_partial_hours',
        'is_approved', 'approved_on', 'approved_by', 'approved_note'
    ];
}
