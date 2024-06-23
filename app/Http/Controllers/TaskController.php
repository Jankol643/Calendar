<?php

namespace App\Http\Controllers;

require_once 'Helpers/util.php';
require_once 'calendar.php';

use App\Http\Controllers\Helpers\ArrayHelper;
use App\Http\Controllers\Helpers\StringHelper;
use \Illuminate\Http\Request;
use App\Models\Task;
use DateTime;
use Exception;
use DateInterval;

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

            if ($line[0] === 'r' && ArrayHelper::isNullOrUndefined($line, 4, 8)) {
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
     * Creates a new Task object from a request.
     *
     * @param Request $request - The request data containing task information.
     * @return Task - The created Task object.
     */
    function createTaskFromRequest(Request $request) {
        $params = $this->validateInput($request);
        if ($params === false) {
            return back()->with('error', 'Invalid input data.')->withInput();
        }
        // Create a new Task object with the sanitized data
        $task = new Task(
            $params['id'],
            $params['recurr'],
            $params['freq_no'],
            $params['freq_dur'],
            $params['last_exec'],
            $params['due_date'],
            $params['task_cat'],
            $params['task_name'],
            $params['task_descr'],
            $params['task_dur'],
            $params['prio']
        );

        // Return the Task object
        return $task;
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

    /**
     * Generates recurring tasks
     * @param int $freq_no - the frequency number
     * @param string $freq_dur - the frequency duration (e.g., 'days', 'weeks','months', 'years')
     * @param DateTime $last_exec - the last execution date
     */
    function generateTasksUntilFreq(int $freq_no, string $freq_dur, DateTime $last_exec): void {
        $interval = new DateInterval($freq_dur);
        $interval->m = $interval->m * $freq_no; // Adjust month interval based on frequency number
        $interval->y = $interval->y * $freq_no; // Adjust year interval based on frequency number

        $targetDate = clone $last_exec;
        $targetDate->add($interval);

        while ($targetDate <= new DateTime()) {
            $task = new Task([
                $this->id,
                true,
                $freq_no,
                $this->freq_dur,
                clone $last_exec,
                clone $targetDate,
                $this->task_cat,
                $this->task_name,
                $this->task_descr,
                $this->task_dur,
                $this->prio
            ]);
            $task->save();

            $last_exec->add($interval);
            $targetDate->add($interval);
        }
    }

    /**
     * Validates the input data for a task creation request.
     * @param Request $request The request data.
     * @return array|false The validated and sanitized input data, or false if validation fails.
     */
    public static function validateInput(Request $request): array {
        $validated = [];
        $validationRules = [
            'id' => 'required|integer',
            'recurr' => 'required|boolean',
            'freq_no' => 'required|integer',
            'freq_dur' => 'required',
            'last_exec' => 'required',
            'due_date' => 'required|date_format:m/d/Y',
            'task_cat' => 'required',
            'task_name' => 'required',
            'task_descr' => 'required',
            'task_dur' => 'required|integer',
            'prio' => 'required|integer',
        ];

        foreach ($validationRules as $field => $rules) {
            $value = $request->get($field);

            if (strpos($rules, 'required') !== false && empty($value)) {
                return false; // Return false if any required field is missing
            }

            if (strpos($rules, 'integer') !== false) {
                $value = filter_var($value, FILTER_VALIDATE_INT);
                if ($value === false) {
                    return false; // Return false if the value is not an integer
                }
            }

            if (strpos($rules, 'boolean') !== false) {
                $value = filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
                if ($value === null) {
                    return false; // Return false if the value is not a boolean
                }
            }

            if (strpos($rules, 'date_format:m/d/Y') !== false) {
                $date = DateTime::createFromFormat('m/d/Y', $value);
                $dateErrors = DateTime::getLastErrors();
                if ($dateErrors['warning_count'] + $dateErrors['error_count'] > 0) {
                    return false; // Return false if the value is not a valid date in the format 'm/d/Y'
                }
            }

            $validated[$field] = $value;
        }

        return $validated;
    }

    function writeToCSV($taskList, $path) {
        $taskList = Task::getAllTasks();
        $file = fopen($path, 'w'); // Open the file in write mode
        if ($file) {
            foreach ($taskList as $row) {
                fwrite($file, $row . "\n");
            }
            return view('success')->with('message', 'Tasks successfully written to file ' . $path);
        } else {
            return view('error')->with('message', 'File ' . $path . ' is corrupt. Writing to CSV aborted.');
        }
        fclose($file);
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
