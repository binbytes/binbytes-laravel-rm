<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
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
        'title', 'description', 'start_date', 'start_date_partial_hours', 'end_date', 'end_date_partial_hours'
    ];

    /**
     * Get upcoming holidays
     *
     * @param $query
     */
    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>=', today());
    }
}
