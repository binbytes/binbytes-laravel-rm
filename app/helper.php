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
                $timezones[$key] = $timezone;
            }

            return $timezones;
        });
    }
}
