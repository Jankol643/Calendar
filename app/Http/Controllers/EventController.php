<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class EventController extends Controller {
    /**
     * This function generates an HTML form for creating or updating an event.
     *
     * @param string $action The action attribute of the form. Default is '/add-event'.
     * @param string $method The method attribute of the form. Default is 'POST'.
     * @return string The generated HTML form.
     */
    function buildEventForm($action = '/add-event', $method = 'POST') {
        $form = '<form action="' . $action . '" method="' . $method . '">';
        $fillable = (new Event())->getFillable();
        $columns = Schema::getColumnListing('events');

        foreach ($fillable as $fillableColumn) {
            if (in_array($fillableColumn, $columns)) {
                $field = '<div class="mb-3">';
                $field .= '<label for="' . $fillableColumn . '" class="form-label">' . ucfirst($fillableColumn) . '</label>';

                $columnType = Schema::getColumnType('events', $fillableColumn);

                if ($fillableColumn == 'event_description') {
                    $field .= '<textarea class="form-control" id="' . $fillableColumn . '" name="' . $fillableColumn . '" rows="3"></textarea>';
                } else {
                    $inputType = 'text';
                    if ($columnType == 'date') {
                        $inputType = 'date';
                    } elseif ($columnType == 'time') {
                        $inputType = 'time';
                    }

                    $field .= '<input type="' . $inputType . '" class="form-control" id="' . $fillableColumn . '" name="' . $fillableColumn . '" ' . ($fillableColumn == 'event_name' || $fillableColumn == 'event_description' ? 'required' : '') . '>';
                }

                $field .= '</div>';
                $form .= $field;
            }
        }

        $form .= '</form>';
        return $form;
    }

    function store(Request $request) {
        $event = new Event();
        $event->create($request);
        return response()->json($event, 201);
    }

    function edit($id) {
        $event = Event::get($id);
        return view('calendar.edit_event_form', compact('event'));
    }

    function update(Request $request, $id) {
        $event = Event::get($id);
        $event->update($request->all());
        return response()->json($event);
    }

    function delete($id) {
        $event = Event::get($id);
        $event->delete();
        return response()->json(null, 204);
    }

    function index() {
        $events = Event::all();
        return view('calendar.index', compact('events'));
    }

    function show($id) {
        $event = Event::findOrFail($id);
        return response()->json($event);
    }
}
