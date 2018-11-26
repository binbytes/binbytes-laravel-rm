<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Project extends Model
{
    use HasSlug;
    use \Spatie\Tags\HasTags;

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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo('App\Client');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeCompleted($query)
    {
        return $query->where('is_completed', true);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeRunning($query)
    {
        return $query->where('is_completed', false);
    }
}
