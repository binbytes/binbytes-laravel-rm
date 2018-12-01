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

if(!function_exists('priority')) {
    function priority() {
        $priority = [];
        for($a = 0; $a<10; $a++) {
            $priority[$a] = $a;
        }
        return $priority;
    }
}

if(!function_exists('months')) {
    function months() {
        $months = [];
        for($m=1; $m <= 12; $m++) {
            $months[$m] = date('F', mktime(0,0,0,$m));
        }
        return $months;
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

        $hours = floor($seconds/3600);
        if ($hours < 10) {
            $hours = '0'.$hours;
        }

        $minute = floor(($seconds/60)%60);
        if ($minute < 10) {
            $minute = '0'.$minute;
        }

        return $hours.":".$minute;
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

if(!function_exists('amountStrToFloat')) {
    /**
     * Get float value from amount string
     * @param $amountString
     *
     * @return float
     */
    function amountStrToFloat($amountString)
    {
        return floatval(str_replace(',', '', $amountString));
    }
}