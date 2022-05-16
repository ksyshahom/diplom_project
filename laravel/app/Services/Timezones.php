<?php

namespace App\Services;

use DateTime;
use DateTimeZone;

class Timezones
{
    public static function getList(): array
    {
        $timezonesList = [];
        $timezones = timezone_identifiers_list();
        foreach ($timezones as $timezone) {
            $datetime = new DateTime();
            $datetimeZone = new DateTimeZone($timezone);
            $datetime->setTimeZone($datetimeZone);
            //
            $name = $timezone . ' (UTC' . $datetime->format('P') . ')';
            $timezonesList[$name] = [
                'region' => $timezone,
                'offset' => $datetime->format('Z'),
            ];
        }
        return $timezonesList;
    }
}
