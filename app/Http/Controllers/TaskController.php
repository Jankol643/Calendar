<?php

namespace App\Http\Controllers;

require_once 'Helpers/util.php';
require_once 'calendar.php';

use App\Http\Controllers\Helpers\Util;
use \Illuminate\Http\Request;
use App\Models\Task;
use DateTime;
use Exception;

class TaskController {
    /**
     * @var int $id - a unique identifier for the task
     * @var bool $recurr - a boolean indicating whether the task recurs or not
     * @var int $freq_no - the frequency duration for recurring tasks
     * @var int $freq_dur - how long the task should be executed
     * @var DateTime $last_exec - the last execution date for recurring tasks
     * @var DateTime $due_date - the date when the task is due
     * @var string $task_cat - the category of the task
     * @var string $task_name - the name of the task
     * @var string $task_descr - a description of the task
     * @var int $task_dur - the duration of the task
     * @var int $prio - the priority of the task
     */
    private $id;
    private $recurr;
    private $freq_no;
    private $freq_dur;
    private $last_exec;
    private $due_date;
    private $task_cat;
    private $task_name;
    private $task_descr;
    private $task_dur;
    private $prio;

    /**
     * Creates task from a specified line
     * @param string|array $line - line with task information
     * @return Task - created task
     * @throws Exception - if recurring task is not completely filled
     */
    public static function createTask($line) {
        try {
            $line = is_string($line) ? explode(',', $line) : $line;

            if ($line[0] === 'r' && Util::isNullOrUndefined($line, 4, 8)) {
                return back()->with('error', 'recurring task not completely filled.');
            }

            $t = Task::createTask((int)$line[0], (int)$line[1], (int)$line[3], new DateTime($line[4]), new DateTime($line[5]), $line[6], $line[7], $line[8], $line[9], $line[10]);
            $t->save();
            return $t;
        } catch (Exception $e) {
            // Handle the exception here
            // You can log the error, display a user-friendly message, or take any other appropriate action
            throw $e;
        }
    }

    /**
     * Adds a task from a form submission
     * @param \Illuminate\Http\Request $request - form data
     * @throws Exception - if task could not be created
     */
    public function addTaskFromForm(Request $request) {
        $validatedData = $request->validate([
            'task_no' => 'required',
            // Add validation rules for other form fields here
        ]);

        try {
            $task = $this->createTask(Util::FormToString($request));
            return view('success')->with('message', 'Task ' . $task->id . ' successfully created');
        } catch (Exception $exception) {
            $errorMessage = 'Task ' . $request['task_no'] . ' could not be created.';
            return back()->with('error', $errorMessage)->withInput();
        }
    }

    function saveRecurringTask($task) {
        if ($task->due_date < new DateTime()) {
            $errorMessage = 'Cannot save historic task ' . $task->id . ' with name ' . $task->task_name . ' and due date ' . $task->due_date;
            return back()->with('error', $errorMessage)->withInput();
        }
        for ($i = 1; $i <= $task->freq_no; $i++) {
            $ce = new Task($task->id, true, $task->freq_no, $task->freq_dur, $task->last_exec, $task->due_date, $task->task_cat, $task->task_name, $task->task_descr, $task->task_dur, $task->prio);
            $ce->save();
        }
    }

    function generateTasksUntilDate($targetDate) {
        /* implementation here */
    }

    function generateTasksUntilFreq($frequency) {
        /* implementation here */
    }

    function writeToCSV($taskList, $path) {
        $taskList = Task::getAllTasks();
        $file = fopen($path, 'w'); // Open the file in write mode
        if ($file) {
            foreach ($taskList as $row) {
                fwrite($file, $row . "\n"); // Use double quotes to interpret escape sequences like \n
            }
            return view('success')->with('message', 'Tasks successfully written to file ' . $path);
        } else {
            return view('error')->with('message', 'File ' . $path . ' is corrupt. Writing to CSV aborted.');
        }
        fclose($file); // Close the file after writing
    }

    function csvToJSON($tasks): string|false {
        $rows = explode('\n', $tasks);
        $headers = explode(',', $rows[0]);
        $jsonData = array();
        for ($i = 1; $i < count($rows); $i++) {
            $values = explode(',', $rows[$i]);
            $obj = array();
            for ($j = 0; $j < count($headers); $j++) {
                $obj[$headers[$j]] = $values[$j];
            }
            $jsonData[] = $obj;
        }
        return json_encode($jsonData, JSON_PRETTY_PRINT);
    }
}
