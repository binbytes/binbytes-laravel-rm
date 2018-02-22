<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title', 'description', 'client_id', 'is_completed', 'remarks'
    ];

    public function client()
    {
        return $this->belongsTo('App\Client');
    }
}
