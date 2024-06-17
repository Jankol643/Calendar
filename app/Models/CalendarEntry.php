<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CalendarEntry extends Model {
    protected $table = 'calendar_entries';

    protected $fillable = [
        'id',
        'title',
        'description',
        'category',
        'start_date',
        'end_date',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function attendee() {
        return $this->hasOneOrMany(User::class);
    }

    public function create(Request $request) {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'user_id' => 'required|exists:users,id',
        ]);

        $calendarEntry = CalendarEntry::create($request);

        return response()->json($calendarEntry, 201);
    }
    public function index() {
        $calendarEntries = CalendarEntry::all();

        return response()->json($calendarEntries);
    }

    public static function get($id) {
        return self::findOrFail($id);
    }

    function deleteCalendarEntryByNameDate($CalendarEntryName, $dueDate): bool {
        $CalendarEntry = $this->findBy('name', $CalendarEntryName)
            ->where('due_date', $dueDate)
            ->first();

        if ($CalendarEntry) {
            return $CalendarEntry->delete();
        }
        return false;
    }

    function findBy($searchCriteria, $searchTerm) {
        return self::where($searchCriteria, $searchTerm)->get();
    }

    function listCalendarEntrysByDate($startDate, $endDate) {
        $startDate = Carbon::createFromFormat('Y-m-d', $startDate)->startOfDay();
        $endDate = Carbon::createFromFormat('Y-m-d', $endDate)->endOfDay();

        $CalendarEntryList = $this->whereBetween('due_date', [$startDate, $endDate])->get();
        return $CalendarEntryList;
    }

    static function getAllCalendarEntrys() {
        return self::all();
    }


    function generateCalendarEntryJson($CalendarEntryId) {
        $CalendarEntry = self::find($CalendarEntryId);

        if (!$CalendarEntry) {
            return response()->json(['error' => 'CalendarEntry not found'], 404);
        }

        $json = [
            'CalendarEntry_id' => $CalendarEntry->id,
            'CalendarEntry_name' => $CalendarEntry->CalendarEntry_name,
            'CalendarEntry_descr' => $CalendarEntry->CalendarEntry_descr,
            // Include other relevant CalendarEntry properties here
        ];

        return json_encode($json, JSON_PRETTY_PRINT);
    }
}
