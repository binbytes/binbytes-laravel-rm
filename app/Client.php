<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name', 'image', 'skype', 'email', 'linkdin', 'twitter', 'remarks'
    ];
}
