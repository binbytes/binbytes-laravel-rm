<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * @property Collection sessions
 */
class UserAttendance extends Model
{
    protected $dates = [
        'date'
    ];

    /**
     * @var array
     */
    protected $casts = [
        'is_on_leave' => 'boolean',
        'is_absent' => 'boolean'
    ];

    /**
     * @var array
     */
    protected $fillable = [
        'date', 'total_times', 'is_on_leave', 'is_absent',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sessions()
    {
        return $this->hasMany(AttendanceSession::class, 'attendance_id');
    }

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
     * @return mixed
     */
    public function getTotalTimeAttribute()
    {
        return $this->sessions->sum('total_times');
    }

    /**
     * @param User $user
     * @return Model
     */
    public function createSession(User $user)
    {
        return $this->sessions()
            ->create([
                'user_id' => $user->getKey(),
                'start_time' => now(),
                'end_time' => now(),
            ]);
    }

    /**
     * @return Model|\Illuminate\Database\Eloquent\Relations\HasMany|\Illuminate\Database\Query\Builder|null|object
     */
    public function incrementSession()
    {
        $session = $this->sessions()->latest('start_time')
            ->first();

        $endTime = now();
        $session->fill([
            'end_time' => $endTime,
            'total_times' => $endTime->diffInSeconds($session->start_time)
        ])->save();

        $this->fill([
            'total_times' => $this->totalTime
        ])->save();

        return $session;
    }

}
