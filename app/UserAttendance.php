<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @property Collection sessions
 */
class UserAttendance extends Model
{
    public static $HOLIDAY = 'holiday';
    public static $LEAVE = 'leave';
    public static $ABSENT = 'absent';

    /**
     * @var array
     */
    protected $fillable = [
        'date', 'total_times', 'status',
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
     * Get total times in hours.
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
        if ($endTime->diffInSeconds($session->end_time) > config('rm.ping_timeout')) {
            $session = $this->createSession($session->user);
        }

        $session->fill([
            'end_time' => $endTime,
            'total_times' => $endTime->diffInSeconds($session->start_time),
        ])->save();

        $this->fill([
            'total_times' => $this->totalTime,
        ])->save();

        return $session;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model $type
     * @param \App\User $user
     * @param \Carbon\Carbon $date
     * @param $hour
     *
     * @return $this
     */
    public function createAttandanceSession(Model $type, User $user, Carbon $date, $hour)
    {
        $startTime = $date->setTime(0, 0, 0);
        $endTime = $startTime->copy()->addHour($hour);
        $this->sessions()
            ->create([
                'user_id' => $user->getKey(),
                'start_time' => $startTime,
                'end_time' => $endTime,
                'total_times' => $endTime->diffInSeconds($startTime),
                'parent_id' => $type->getKey(),
                'parent_type' => get_class($type),
            ]);

        $this->fill([
            'total_times' => $this->totalTime,
        ])->save();

        return $this;
    }
}
