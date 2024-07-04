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
        'user_id',
        'created_at',
        'updated_at'
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

        $calendarEntry = new CalendarEntry([
            'title' => $data['title'],
            'description' => $data['description'],
            'category' => $data['category'],
            'start_date' => Carbon::parse($data['start_date']),
            'end_date' => Carbon::parse($data['end_date']),
            'user_id' => $data['user_id']
        ]);
        $calendarEntry->save();
        return response()->json($calendarEntry, 201);
    }

    public function index() {
        $calendarEntries = CalendarEntry::all();

        return response()->json($calendarEntries);
    }

    public static function get($id) {
        return self::findOrFail($id);
    }

    public function updateEntry(Request $request, $id) {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'category' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'user_id' => 'required|exists:users,id',
        ]);

        $calendarEntry = self::get($id);
        $calendarEntry->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'category' => $data['category'],
            'start_date' => Carbon::parse($data['start_date']),
            'end_date' => Carbon::parse($data['end_date']),
            'user_id' => $data['user_id'],
        ]);
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

    /**
     * Get all calendar entries as JSON format.
     * @return string A JSON representation of all calendar entries.
     */
    function entriesToJSON() {
        $calendarEntries = CalendarEntry::all();
        return json_encode($calendarEntries);
    }

    /**
     * Sorts a Laravel model by multiple fields with specific orders.
     *
     * @param array $fields An array of field names to sort by.
     * @param array $orders An array of sort orders corresponding to each field.
     *                      Possible values: 'asc' for ascending, 'desc' for descending.
     * @return Illuminate\Database\Eloquent\Collection A collection of sorted model instances.
     */
    public function sortModelByMultipleFields(array $fields, array $orders) {
        $query = CalendarEntry::query();

        for ($i = 0; $i < count($fields); $i++) {
            $query = $query->CalendarEntry->orderBy($fields[$i], $orders[$i]);
        }

        return $query->get();
    }
}
