<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\String\Exception\InvalidArgumentException;

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

    /**
     * Creates a new calendar entry in the database.
     *
     * @param Request $request The incoming request containing the new calendar entry data.
     *
     * @return \Illuminate\Http\JsonResponse The created calendar entry as a JSON response with HTTP status code 201.
     *
     * @throws \Illuminate\Validation\ValidationException If the incoming request data fails validation.
     */
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

    /**
     * Updates an existing calendar entry in the database.
     *
     * @param Request $request The incoming request containing the updated data.
     * @param int $id The ID of the calendar entry to be updated.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException If the incoming request data fails validation.
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the specified calendar entry ID does not exist.
     */
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

    /**
     * Deletes a calendar entry by name and due date.
     *
     * @param string $CalendarEntryName The name of the calendar entry to delete.
     * @param string $dueDate The due date of the calendar entry to delete.
     *
     * @return bool Returns true if the calendar entry is successfully deleted, false otherwise.
     *
     * @throws \Exception If an error occurs during the deletion process.
     */
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

    /**
     * Retrieves a list of calendar entries between a specified start and end date.
     *
     * @param string $startDate The start date in 'Y-m-d' format.
     * @param string $endDate The end date in 'Y-m-d' format.
     * @return Illuminate\Database\Eloquent\Collection A collection of calendar entries between the specified dates.
     *
     * @throws InvalidArgumentException If the provided start or end date is not in the 'Y-m-d' format.
     */
    function listCalendarEntriesByDate($startDate, $endDate) {
        // Validate the date format
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $startDate) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $endDate)) {
            throw new InvalidArgumentException('Invalid date format. Please provide dates in the "Y-m-d" format.');
        }

        $startDate = Carbon::createFromFormat('Y-m-d', $startDate)->startOfDay();
        $endDate = Carbon::createFromFormat('Y-m-d', $endDate)->endOfDay();

        $CalendarEntryList = $this->whereBetween('due_date', [$startDate, $endDate])->get();
        return $CalendarEntryList;
    }

    /**
     * Retrieves all instances of the CalendarEntry model.
     *
     * @return Illuminate\Database\Eloquent\Collection A collection of all CalendarEntry model instances.
     */
    static function getAllCalendarEntries() {
        return self::all();
    }

    /**
     * Get all instances of a specified model as JSON format.
     * @param string $model The name of the model.
     * @return string A JSON representation of all instances of the specified model.
     */
    function entriesToJSON($model) {
        $calendarEntries = $model::all();
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
