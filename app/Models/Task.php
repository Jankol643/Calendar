<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Task extends Model {
    protected $fillable = [
        'name',
        'description',
        'category',
        'due_date',
        'duration',
        'prio',
    ];

    public static function createTask($data) {
        return self::create($data);
    }

    public static function getTask($id) {
        return self::findOrFail($id);
    }

    public function updateTask($data) {
        return $this->update($data);
    }

    public function deleteTask() {
        return $this->delete();
    }

    function deleteTaskByNameDate($taskName, $dueDate): bool {
        $task = $this->findBy('name', $taskName)
            ->where('due_date', $dueDate)
            ->first();

        if ($task) {
            return $task->delete();
        }
        return false;
    }

    function findBy($searchCriteria, $searchTerm) {
        return self::where($searchCriteria, $searchTerm)->get();
    }

    function listTasksByDate($startDate, $endDate) {
        $startDate = Carbon::createFromFormat('Y-m-d', $startDate)->startOfDay();
        $endDate = Carbon::createFromFormat('Y-m-d', $endDate)->endOfDay();

        $taskList = $this->whereBetween('due_date', [$startDate, $endDate])->get();
        return $taskList;
    }

    static function getAllTasks() {
        return Task::all();
    }
}
