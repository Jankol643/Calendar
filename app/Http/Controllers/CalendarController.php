<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalendarController extends Controller
{
    /**
     * Imports calendar tasks from a CSV file
     * @param string $path - path of the CSV file
     * @throws FileNotFoundError if the specified file could not be found
     */
    public function importEntriesFromCSV(string $path): void
    {
        if (!File::exists($path)) { // Fixed File::exists() method call
            throw new FileNotFoundError("The specified file $path could not be found");
        }
        $tasks = []; // Fixed array initialization
        $lines = file($path, FILE_IGNORE_NEW_LINES); // Read all lines from the file
        foreach ($lines as $line) {
            $tasks[] = $line; // Add each line to the tasks array
        }
        for ($i = 0; $i < count($tasks); $i++) {
            $t = TaskController::createTask($tasks[$i], $i); // Fixed TaskController::createTask() method call
        }
    }

    function showDeleteSelect($arr) {

    }

    /**
     * Removes the dark mode class from elements
     */
    public function removeDarkMode()
    {
        $darkTheme = 'dark-theme'; // Your class name
        $itemDivs = document.querySelectorAll('.dark-theme');
        // If dark theme is active, remove class names
        if (readCookie($darkTheme) === 'true') {
            foreach ($itemDivs as $itemDiv) {
                $itemDiv.classList.remove($darkTheme);
            }
        }
    }

    /**
     * Reads a cookie value by name
     * @param string $name - the name of the cookie
     * @return string|null - the value of the cookie or null if not found
     */
    public function readCookie($name)
    {
        $nameEQ = $name . "=";
        $ca = explode(';', $_COOKIE); // Fixed document.cookie.split(';') to $_COOKIE
        foreach ($ca as $c) {
            while (substr($c, 0, 1) === ' ') {
                $c = substr($c, 1, strlen($c));
            }
            if (strpos($c, $nameEQ) === 0) {
                return substr($c, strlen($nameEQ), strlen($c));
            }
        }
        return null;
    }

    /**
     * Sets constants and returns a view
     * @return \Illuminate\Contracts\View\View - the view to be returned
     */
    public function setConstants()
    {
        $requestCookie = request()->cookies; // Fixed HttpContext.Request.Cookies to request()->cookies
        $response = response()->cookies; // Fixed HttpContext.Response.Cookies to response()->cookies
        if (!$requestCookie->has("dark-theme")) { // Fixed $requestCookie.ContainsKey() to $requestCookie->has()
            $response->add("dark-theme", "false"); // Fixed $response.Append() to $response->add()
        }
        return view("Home");
    }
}