<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name', 'company_name', 'avatar', 'timezone', 'address', 'city', 'country', 'dob',
        'mobile_no', 'email', 'skype', 'trello', 'slack', 'github', 'twitter', 'linkedin'
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
}
