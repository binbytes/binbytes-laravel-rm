<?php

namespace App;

trait NotificationHandler
{
    /**
     * Boot the trait.
     */
    protected static function bootNotificationHandler()
    {
        if (auth()->guest()) {
            return;
        }

        // For future use
        foreach (static::getActivitiesToRecord() as $event) {
            static::$event(function ($model) use ($event) {
                $model->recordActivity($event);
            });
        }

        // On delete any records, delete its notification
        static::deleting(function ($model) {
            $model->notifications()->delete();
        });
    }

    /**
     * @return mixed
     */
    public function notifications()
    {
        return $this->hasMany(\App\Notification::class, 'data->id')
                    ->whereIn('type', self::$notifications);
    }

    /**
     * Fetch all model events that require activity recording.
     *
     * @return array
     */
    protected static function getActivitiesToRecord()
    {
        return [];
    }
}
