<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttendanceSession extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'user_id', 'attendance_id', 'start_time', 'end_time', 'total_times', 'parent_id', 'parent_type',
    ];

    /**
     * @var array
     */
    protected $dates = [
        'start_time',
        'end_time',
    ];

    /**
     * Get total times in hours.
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function updateRequest()
    {
        return $this->hasMany(AttendanceSessionUpdate::class, 'session_id');
    }

    /**
     * @param $sessionUpdate
     * @return AttendanceSession
     */
    public function updateAttendanceSession($sessionUpdate)
    {
        $this->fill([
            'start_time' => $sessionUpdate->start_time,
            'end_time' => $sessionUpdate->end_time,
            'total_times' => ($sessionUpdate->end_time)->diffInSeconds($sessionUpdate->start_time),
        ])->save();

        $this->attendance->fill([
            'total_times' => $this->attendance->totalTime,
        ])->save();

        return $this;
    }
}
