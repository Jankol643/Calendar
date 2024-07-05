<?php

use Illuminate\Support\Facades\Log;

// Helper function to format and print a variable
function format_var($var) {
    return print_r($var, true);
}

// Add your other helper functions here

// Example helper functions
function debug_log($message) {
    Log::debug($message);
}

function success_response($data) {
    return response()->json(['success' => true, 'data' => $data], 200);
}

function error_response($message, $code = 400) {
    return response()->json(['success' => false, 'error' => $message], $code);
}

// ... (add twenty more helper functions as needed)

// Include the bootstrap file in the composer autoload
require_once __DIR__ . '/bootstrap.php';
