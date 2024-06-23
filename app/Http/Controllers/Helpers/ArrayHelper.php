<?php

namespace App\Http\Controllers\Helpers;

use Brick\Math\Exception\NegativeNumberException;
use Illuminate\Support\Facades\Log;

class StringHelper {

    /**
     * Checks if an array is null or any of its values are null or NaN
     * @param {*} $arr - array to check
     * @param {int} $from - lower limit to check - 0 if omitted
     * @param {int|null} $to - upper limit to check - length of array if omitted
     * @return bool - true if the array is null or contains null or NaN values
     */
    public static function isNullOrUndefined(array $arr, int $from = 0, int $to = null) {
        if (!$arr) {
            return true;
        }
        if ($to === null) {
            $to = count($arr);
        }
        for ($i = $from; $i < $to; $i++) {
            if ($arr[$i] === null || is_nan($arr[$i])) {
                return true;
            }
        }
        return false;
    }

    /**
     * Inserts a string into an array at every position
     * @param {string} $str - string to insert
     * @param {array} $arr - array to insert into
     * @return array - array with the string inserted at every position
     */
    public function insertStrIntoArr(string $str, array $arr): array {
        $cnt = 0;
        foreach ($arr as $item) {
            array_splice($arr, $cnt, 0, $str);
            $cnt++;
        }
        return $arr;
    }

    /**
     * Converts an associative array to a string representation.
     *
     * @param array $data The associative array to convert.
     * @return string The string representation of the array.
     */
    public static function arrayToString(array $data): string {
        $result = '';
        foreach ($data as $key => $value) {
            $result .= $key . '=' . $value . '&';
        }
        // Remove the last '&' character
        $result = rtrim($result, '&');
        return $result;
    }

    /**
     * Sets all the variables in the array null and returns them as single variables.
     *
     * @param array $arr The array containing the variables to be nullified.
     * @param string $set The value to set for each variable.
     *
     * @return int The number of variables successfully extracted from the array.
     *
     * @throws Exception If the extract() function fails to extract any variables.
     */
    function set_array_variables(array $arr, string $set) {
        foreach ($arr as &$var) {
            $var = $set;
        }
        $result = extract($arr);

        if ($result === 0) {
            throw new Exception('Failed to extract any variables from the array.');
        }
        return $result;
    }

    /**
     * Divides an array into smaller chunks of a specified size.
     *
     * @param array $data The array to be divided into chunks.
     * @param int $chunkSize The size of each chunk.
     *
     * @return void This function does not return a value, but it logs each chunk to the debug log.
     *
     * @throws NegativeNumberException If the chunk size is less than or equal to zero.
     */
    public static function logChunks(array $data, int $chunkSize, string $arrayName) {
        // Check if the chunk size is valid
        if ($chunkSize <= 0) {
            throw new NegativeNumberException('Chunk size must be greater than zero.');
        }

        // Divide the data array into chunks
        while (!empty($data)) {
            // Extract a chunk of the specified size from the data array
            $chunk = array_slice($data, 0, $chunkSize);

            // Log the chunk to the debug log
            Log::debug($arrayName . " chunk: " . print_r($chunk, true));

            // Remove the chunk from the data array
            $data = array_slice($data, $chunkSize);
        }
    }
}
