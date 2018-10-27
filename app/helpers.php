<?php

use Carbon\Carbon;

if(!function_exists('timeZoneList')) {

    /**
     * Get all timezone list for select
     * @return mixed
     */
    function timeZoneList() {
        return \Cache::rememberForever('timezones', function () {
            $optionsArray = timezone_identifiers_list();
            $timezones = [];
            foreach ($optionsArray as $key => $timezone) {
                $timezones[$timezone] = $timezone;
            }

            return $timezones;
        });
    }
}

if(!function_exists('hoursFromSeconds')) {
    /**
     * Get readable hours from seconds
     *
     * @param $seconds
     * @return float
     */
    function hoursFromSeconds($seconds) {
        return number_format($seconds / 3600, 2);
    }
}

if(!function_exists('generateDateRange')) {

    /**
     * Generate Date range.
     *
     * @param \Carbon\Carbon $start
     * @param \Carbon\Carbon $end
     * @param string $interval
     *
     * @return array
     */
    function generateDateRange(Carbon $start, Carbon $end, $interval = '1 day')
    {
        $interval = \DateInterval::createFromDateString($interval);
        $daterange = new \DatePeriod($start->second(0), $interval, $end->second(0));

        $dates = [];
        foreach ($daterange as $date) {
            $dates[] = new Carbon($date);
        }
        return $dates;
    }
}