<?php

namespace App\Http\Controllers\Helpers;

use DateTime;

class DateUtil {
    public static function get_random_date(DateTime $startDate, DateTime $endDate): DateTime {
        $yearMin = (int) $startDate->format("Y");
        $yearMax = (int) $endDate->format("Y");
        $year = mt_rand($yearMin, $yearMax);
        $month = mt_rand(1, 12);
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $day = mt_rand(1, $daysInMonth);
        $dateString = $year . '-' . $month . '-' . $day;
        return new DateTime($dateString);
    }
}
