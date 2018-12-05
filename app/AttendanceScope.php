<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

trait AttendanceScope
{
    /**
     * Get upcoming holidays
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>=', today());
    }

    /**
     * Get past holiday
     *
     * @param $query
     *
     * @return mixed
     */
    public function scopePast($query)
    {
        return $query->where('start_date', '<=', today());
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Carbon\Carbon $date
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder
     */
    public function scopeBetweenDate(Builder $query, Carbon $date)
    {
        return $query->whereDate('start_date', '<=', $date)
            ->whereDate('end_date', '>=', $date);
    }
}