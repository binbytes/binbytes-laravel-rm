<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttendanceSessionUpdate extends Model
{
    protected $fillable = [
        'session_id', 'start_time', 'end_time', 'note'
    ];

    public $dates = [
        'start_time', 'end_time'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attendanceSession()
    {
        return $this->belongsTo(AttendanceSession::class, 'session_id');
    }
}
