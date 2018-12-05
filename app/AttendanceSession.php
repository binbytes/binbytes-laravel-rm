<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttendanceSession extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'user_id', 'attendance_id', 'start_time', 'end_time', 'total_times', 'parent_id', 'parent_type'
    ];

    /**
     * @var array
     */
    protected $dates = [
        'start_time',
        'end_time',
    ];

    /**
     * Get total times in hours
     *
     * @return float
     */
    public function getHoursAttribute()
    {
        return hoursFromSeconds($this->total_times);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attendance()
    {
        return $this->belongsTo(UserAttendance::class, 'attendance_id');
    }
}
