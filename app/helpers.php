<?php

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