<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'middle_name', 'username', 'email', 'personal_email', 'password', 'dob', 'avatar', 'address',
        'mobile_no', 'skype', 'trello', 'slack', 'github', 'twitter', 'linkedin'
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
        return asset($this->avatar);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attendance()
    {
        return $this->hasMany(UserAttendance::class);
    }

    /**
     * @return UserAttendance|object|null
     */
    public function getTodayAttendanceAttribute()
    {
        return $this->attendance()
            ->where('date', today())
            ->first();
    }

    /**
     * @return UserAttendance|\Illuminate\Database\Eloquent\Model
     */
    public function firstOrCreateAttendance()
    {
        if ($attendance = $this->today_attendance) {
            return $attendance;
        }

        return $this->attendance()->create([
            'date' => today()
        ]);
    }
}
