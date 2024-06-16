<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalendarEntry extends Model {
    protected $table = 'calendar_entries';

    protected $fillable = [
        'id',
        'title',
        'description',
        'start_date',
        'end_date',
        'user_id'
    ]; 

    // Define the common attributes and methods for all submodels

    public function location() {
        return $this->hasOne(Location::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function attendee() {
        return $this->hasOneOrMany(User::class);
    }

    public static function createEntry($data) {
        return self::create($data);
    }

    public static function getEntry($id) {
        return self::findOrFail($id);
    }

    public function updateEntry($data) {
        return $this->update($data);
    }

    public function deleteEntry() {
        return $this->delete();
    }

    function deleteEntryByNameDate($EntryName, $dueDate): bool {
        $Entry = $this->findBy('name', $EntryName)
            ->where('due_date', $dueDate)
            ->first();

        if ($Entry) {
            return $Entry->delete();
        }
        return false;
    }

    function findBy($searchCriteria, $searchTerm) {
        return self::where($searchCriteria, $searchTerm)->get();
    }

    function listEntrysByDate($startDate, $endDate) {
        $startDate = Carbon::createFromFormat('Y-m-d', $startDate)->startOfDay();
        $endDate = Carbon::createFromFormat('Y-m-d', $endDate)->endOfDay();

        $EntryList = $this->whereBetween('due_date', [$startDate, $endDate])->get();
        return $EntryList;
    }

    static function getAllEntrys() {
        return Entry::all();
    }
}

function generateEntryJson($EntryId) {
    $Entry = Entry::find($EntryId);

    if (!$Entry) {
        return response()->json(['error' => 'Entry not found'], 404);
    }

    $json = [
        'Entry_id' => $Entry->id,
        'Entry_name' => $Entry->Entry_name,
        'Entry_descr' => $Entry->Entry_descr,
        // Include other relevant Entry properties here
    ];

    $jsonString = json_encode($json, JSON_PRETTY_PRINT);

    Storage::disk('local')->put('Entry_' . $EntryId . '.json', $jsonString);

    return response()->json(['message' => 'JSON file generated successfully']);
}

}
