<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttendanceSession extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'user_id', 'attendance_id', 'start_time', 'end_time', 'total_hours',
    ];

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
