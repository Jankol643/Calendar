<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\Exception\FileNotFoundException;

class CalendarController extends Controller
{
    public function index()
    {
        return view('calendar')->with('calendar_type', 'own');
    }

    /**
     * Imports calendar tasks from a CSV file
     * @param string $path - path of the CSV file
     * @throws FileNotFoundException if the specified file could not be found
     */
    function importEntriesFromCSV(string $path): void
    {
        if (!file_exists($path)) { // Fixed File::exists() method call
            throw new FileNotFoundException("The specified file $path could not be found");
        }
        $tasks = [];
        $lines = file($path, FILE_IGNORE_NEW_LINES);
        foreach ($lines as $line) {
            $tasks[] = $line;
        }
        for ($i = 0; $i < count($tasks); $i++) {
            TaskController::createTask($tasks[$i], $i);
        }
    }

    function showDeleteSelect($arr)
    {
    }
}