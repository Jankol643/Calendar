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

    /**
     * Adds a specific number of months to a date
     * @param {Date} date - date to add months to
     * @param {*} months - number of months to add
     * @returns Date - date with months added
     */
    function addMonths($date, $months) {
        $day = $date->format('d');
        $date->modify("+$months months");
        if ($date->format('d') != $day) {
            $date->modify('last day of previous month');
        }
        return $date;
    }

    /**
     * Calculates the Easter Sunday date for a given year
     * @param {number} year - the year for which to calculate the Easter Sunday date
     * @returns {Date} - the Easter Sunday date for the given year
     */
    function gaussEaster(int $year) {
        // All calculations done on the basis of Gauss Easter Algorithm
        $A = $year % 19;
        $B = $year % 4;
        $C = $year % 7;
        $P = floor($year / 100.0);

        $Q = floor((13 + 8 * $P) / 25.0);
        $M = floor(15 - $Q + $P - floor($P / 4)) % 30;
        $N = floor(4 + $P - floor($P / 4)) % 7;
        $D = floor(19 * $A + $M) % 30;
        $E = floor(2 * $B + 4 * $C + 6 * $D + $N) % 7;

        $days = floor(22 + $D + $E);

        // A corner case,
        // when D is 29
        if (($D == 29) && ($E == 6)) {
            echo $year . "-04-19";
            return;
        }
        // Another corner case,
        // when D is 28
        else if (($D == 28) && ($E == 6)) {
            echo $year . "-04-18";
            return;
        } else {
            // If days > 31, move to April
            // April = 4th Month
            if ($days > 31) {
                echo $year . "-04-" . ($days - 31);
                return;
            } else {
                // Otherwise, stay on March
                // March = 3rd Month
                echo $year . "-03-" . $days;
                return;
            }
        }
    }
}
