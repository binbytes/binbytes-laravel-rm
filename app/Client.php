<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name', 'avatar', 'skype', 'email', 'linkedin', 'twitter', 'remarks'
    ];
}
