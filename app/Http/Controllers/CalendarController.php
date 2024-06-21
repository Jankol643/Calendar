<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class CalendarController extends Controller {

    public function buildCalendar() {
        $start_date = '2022-01-26';
        $end_date = '2022-02-06';

        $current_date = $start_date;
        $calendar_html = '';
        while ($current_date <= $end_date) {
            $day_of_week = date('D', strtotime($current_date));
            $day_number = date('j', strtotime($current_date));

            $event_class = '';
            $event_content = '';

            // Add event logic here
            // Example:
            // if ($day_number == 15) {
            //     $event_class = 'current-month';
            //     $event_content = '<div class="event-list"><div class="event-name" style="background: rgb(116, 128, 166);">asdf</div></div>';
            // }

            $calendar_html += '<div class="big-date py-1 ' . $event_class . ' ' . ($day_of_week == 'Sun' ? 'bg-red-100' : ($day_of_week == 'Sat' ? 'bg-blue-100' : '')) . '"><span class="big-date-cell">' . $day_number . '</span>' . $event_content . '</div>';

            $current_date = date('Y-m-d', strtotime($current_date . ' + 1 day'));
        }
        return $calendar_html;
    }
}
