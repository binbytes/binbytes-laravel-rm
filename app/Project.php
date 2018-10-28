<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Project extends Model
{
    use HasSlug;

    protected $casts = [
        'is_completed' => 'boolean'
    ];

    protected $fillable = [
        'title', 'description', 'client_id', 'started_at', 'is_completed', 'slug', 'remarks'
    ];

    public function path()
    {
        return '/projects/' . $this->id;
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions()
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
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
