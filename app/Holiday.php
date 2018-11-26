<?php

namespace App;

use App\Notifications\HolidayAdded;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use NotificationHandler;

    /**
     * Notifications related to Leave
     * @var array
     */
    public static $notifications = [
        HolidayAdded::class
    ];

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
     *
     * @return mixed
     */
    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>=', today());
    }

    /**
     * Get past holiday
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopePast($query)
    {
        return $query->where('start_date', '<=', today());
    }
}
