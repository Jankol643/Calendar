<?php

class TaskScheduler {
    private $calendarEntries;
    private $officeHours;

    public function __construct($calendarEntries, $officeHours) {
        $this->calendarEntries = $calendarEntries;
        $this->officeHours = $officeHours;
    }

    public function scheduleTasks($tasks) {
        // Sort tasks by due date and priority
        usort($tasks, function ($a, $b) {
            if ($a->dueDate == $b->dueDate) {
                return $a->priority - $b->priority;
            }
            return $a->dueDate - $b->dueDate;
        });

        $scheduledTasks = [];

        foreach ($tasks as $task) {
            $scheduledTask = $this->findAvailableTimeSlot($task);
            if ($scheduledTask) {
                $scheduledTasks[] = $scheduledTask;
            }
        }

        return $scheduledTasks;
    }

    private function findAvailableTimeSlot($task) {
        $taskDuration = $task->duration;
        $taskDueDate = $task->dueDate;

        // Loop through office hours to find an available time slot
        foreach ($this->officeHours as $startTime => $endTime) {
            // Check if task can be scheduled within this time slot
            if ($taskDuration <= ($endTime - $startTime)) {
                // Check if there are any conflicting calendar entries
                $conflict = false;
                foreach ($this->calendarEntries as $entry) {
                    // Check if the task overlaps with any existing calendar entry
                    if (($taskDueDate >= $entry->startTime && $taskDueDate < $entry->endTime) ||
                        ($taskDueDate + $taskDuration > $entry->startTime && $taskDueDate + $taskDuration <= $entry->endTime)
                    ) {
                        $conflict = true;
                        break;
                    }
                }

                if (!$conflict) {
                    // Schedule the task in this time slot
                    $scheduledTask = new stdClass();
                    $scheduledTask->task = $task;
                    $scheduledTask->startTime = $taskDueDate;
                    $scheduledTask->endTime = $taskDueDate + $taskDuration;

                    return $scheduledTask;
                }
            }
        }

        // If no available time slot is found, return null
        return null;
    }
}

// Example usage
$calendarEntries = [
    // Existing calendar entries
    // ...
];

$officeHours = [
    '07:00' => '21:00' // Define your office hours here
];

$tasks = [
    // Array of tasks with priority, due date, and duration
    // ...
];

$taskScheduler = new TaskScheduler($calendarEntries, $officeHours);
$scheduledTasks = $taskScheduler->scheduleTasks($tasks);

// Print the scheduled tasks
foreach ($scheduledTasks as $scheduledTask) {
    echo "Task: " . $scheduledTask->task->name . "\n";
    echo "Start Time: " . $scheduledTask->startTime . "\n";
    echo "End Time: " . $scheduledTask->endTime . "\n";
    echo "\n";
}
