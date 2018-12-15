<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use \Spatie\Tags\HasTags;

//    public $dates = [
//        'dob', 'joining_date', 'leaving_date'
//    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'middle_name', 'username', 'email', 'personal_email', 'password', 'dob', 'avatar',
        'address', 'designation', 'about', 'mobile_no', 'skype', 'trello', 'slack', 'github', 'twitter', 'linkedin',
        'weekly_hours_credit', 'base_salary', 'joining_date', 'leaving_date', 'is_active', 'use_icon_sidebar',
        'exclude_from_salary', 'exclude_from_attendance', 'role', 'remarks'
    ];

    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get avatar url
     *
     * @return string
     */
    public function getAvatarUrlAttribute()
    {
        return \Storage::url($this->avatar);
    }

    /**
     * @param Builder $query
     * @param \Carbon\Carbon $date
     *
     * @return mixed
     */
    public function scopeDoesntOnLeave(Builder $query, Carbon $date)
    {
        return $query->whereDoesntHave('leaves', function ($query) use ($date)  {
            $query->betweenDate($date)
                ->where('is_approved', true);
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attendance()
    {
        return $this->hasMany(UserAttendance::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    /**
     * @return UserAttendance|object|null
     */
    public function getTodayAttendanceAttribute()
    {
        return $this->attendanceOfTheDay(today());
    }

    /**
     * @param $startDate
     * @param $endDate
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\HasMany|null|object
     */
    public function attendanceFromDates($startDate, $endDate)
    {
        return $this->attendance()
            ->whereBetween('date', [$startDate, $endDate])
            ->get();
    }

    /**
     * @param $date
     * @return UserAttendance|null|object
     */
    public function attendanceOfTheDay($date)
    {
        return $this->attendance()
            ->where('date', $date)
            ->first();
    }

    /**
     * @param $startDate
     * @param $endDate
     * @return \Illuminate\Support\Collection
     */
    public function dateRangeAttendances($startDate, $endDate)
    {
        if($startDate instanceof Carbon === false) {
            $startDate = Carbon::createFromFormat('Y-m-d', $startDate);
        }

        if($endDate instanceof Carbon === false) {
            $endDate = Carbon::createFromFormat('Y-m-d', $endDate);
        }

        $days = generateDateRange($startDate, $endDate->addDay(1), '1 day');

        $attendances = $this->attendanceFromDates($startDate->toDateString(), $endDate->toDateString());

        return collect($days)->map(function (Carbon $day) use($attendances) {
            $attendance = $attendances->where('date', $day->format('Y-m-d'))->first();

            return [
                'id' => $attendance ? $attendance->getKey() : null,
                'date' => $day->format('Y-m-d'),
                'day' => $day->format('D'),
                'hours' => $attendance ? $attendance->hours : 0,
                'second' => $attendance ? $attendance->total_times : 0,
                'is_on_leave' => $attendance && $attendance->is_on_leave,
            ];
        });
    }

    /**
     * @return UserAttendance|object|null
     */
    public function getWeekAttendancesAttribute()
    {
        return $this->dateRangeAttendances(today()->startOfWeek(), today()->endOfWeek());
    }

    /**
     * @return int
     */
    public function getWeeklyWorksHrsPercentage()
    {
        $weekSeconds = $this->week_attendances->sum('second');
        if(!$weekSeconds) {
            return 0;
        } elseif ($weekSeconds >= $this->weekly_hours_credit * 3600) {
            return 100;
        }

        return number_format(($weekSeconds * 100) / ($this->weekly_hours_credit * 3600), 2);
    }

    /**
     * @return UserAttendance|\Illuminate\Database\Eloquent\Model
     */
    public function firstOrCreateAttendance()
    {
        if ($attendance = $this->today_attendance) {
            return $attendance;
        }

        return $this->createAttendance(today());
    }

    /**
     * @param \Carbon\Carbon $date
     * @param array $data
     *
     * @return \App\UserAttendance
     */
    public function createAttendance(Carbon $date, array $data = [])
    {
        return $this->attendance()->create(array_merge([
            'date' => $date
        ], $data));
    }

    /**
     * @param \Carbon\Carbon $date
     *
     * @return \App\UserAttendance
     */
    public function createAbsent(Carbon $date)
    {
        return $this->createAttendance($date, [
            'status' => UserAttendance::$ABSENT
        ]);
    }

    /**
     * Get recent notifications
     *
     * @return mixed
     */
    public function getRecentNotifications()
    {
        return $this->notifications()->take(5)->get();
    }

    /**
     * Is user excluded from attendance
     *
     * @return mixed
     */
    public function attendanceExcluded()
    {
        return $this->exclude_from_attendance == true;
    }

    /**
     * Is user excluded from salary
     *
     * @return mixed
     */
    public function salaryExcluded()
    {
        return $this->exclude_from_salary == true;
    }

    /**
     * Detect is user object is mine
     */
    public function isMe()
    {
        return $this->id == auth()->id();
    }

    /**
     * Determine if user is admin
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Determine if user is employee
     *
     * @return bool
     */
    public function isEmployee()
    {
        return $this->role === 'employee';
    }

    /**
     * Determine if user is accountant
     *
     * @return bool
     */
    public function isAccountant()
    {
        return $this->role === 'accountant';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function designations()
    {
        return $this->belongsToMany(Designation::class)
                    ->withTimestamps()
                    ->orderByDesc('pivot_created_at');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }

    /**
     * Get user's current designation
     *
     * @return string
     */
    public function getDesignationAttribute()
    {
        return $this->designations->first();
    }
}
