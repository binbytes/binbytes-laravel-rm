<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectProgress extends Model
{
    protected $fillable = [
        'description', 'project_id', 'user_id', 'date',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('App\Project');
    }
}
