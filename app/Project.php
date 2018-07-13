<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title', 'description', 'client_id', 'started_at', 'is_completed', 'slug', 'remarks'
    ];

    public function path()
    {
        return '/projects/' . $this->id;
    }

    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
