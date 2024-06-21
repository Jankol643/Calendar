<?php

namespace App\Http\Controllers\Helpers;

use Exception;
use Illuminate\Support\Facades\Log;

class Util {
    /**
     * Checks if a server file exists, is not empty and has the specified extension
     * @param {string} $path - path to the file
     * @param {string} $ext - file extension 
     * @return bool - true if the file passes all checks, false otherwise
     */
    public static function FileOK($path, $ext) {
        // Check if the file exists
        if (!file_exists($path)) {
            return false;
        }

        // Check if the file is not empty
        if (filesize($path) == 0) {
            return false;
        }

        // Check if the file has the specified extension
        $fileExt = pathinfo($path, PATHINFO_EXTENSION);
        if ($fileExt != $ext) {
            return false;
        }

        // All checks passed, return true
        return true;
    }

    /**
     * Gets the extension of a file from its path
     * @param {string} $path - path to the file
     * @return string - file extension
     */
    public static function getExtension($path) {
        $basename = basename($path);
        $pos = strrpos($basename, ".");
        if ($basename === "" || $pos === false || $pos === 0) {
            return "";
        }
        return substr($basename, $pos + 1);
    }

    /**
     * Checks if an array is null or any of its values are null or NaN
     * @param {*} $arr - array to check
     * @param {int} $from - lower limit to check - 0 if omitted
     * @param {int|null} $to - upper limit to check - length of array if omitted
     * @return bool - true if the array is null or contains null or NaN values
     */
    public static function isNullOrUndefined($arr, $from = 0, $to = null) {
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
     * Checks if a line is complete
     * @param {string} $line - line to check
     * @return bool - true if the line is complete
     */
    public function isLineComplete($line) {
        $splitted = explode(',', $line);
        if (count($splitted) != 8) {
            return false;
        }
        if ($splitted[0] == 1) {
            if (!$this->isNullOrUndefined($splitted, 1, 1)) {
                return false;
            }
            if (!$this->isNullOrUndefined($splitted, 3, 7)) {
                return false;
            }
            return true;
        }
        return false;
    }

    /**
     * Converts an object to an SQL array
     * @param {object} $obj - object to convert
     * @return array - SQL array representation of the object
     */
    public function toSQLArray($obj) {
        $arr = [];
        $cnt = 0;
        foreach ($obj as $prop => $value) {
            if (!property_exists($obj, $prop)) {
                continue;
            }
            $arr[$cnt] = $prop;
            $cnt++;
        }
        $arr = $this->insertStrIntoArr(", ", $arr);
        return $arr;
    }

    /**
     * Inserts a string into an array at every position
     * @param {string} $str - string to insert
     * @param {array} $arr - array to insert into
     * @return array - array with the string inserted at every position
     */
    public function insertStrIntoArr($str, $arr) {
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
    public static function FormToString($data) {
        $result = '';
        foreach ($data as $key => $value) {
            $result .= $key . '=' . $value . '&';
        }
        // Remove the last '&' character
        $result = rtrim($result, '&');
        return $result;
    }

    /**
     * Checks if a form is complete by verifying if all required fields are present.
     *
     * @param array $data The associative array representing the form data.
     * @return bool True if the form is complete, false otherwise.
     */
    public static function isFormComplete($data) {
        // Check if all required fields are present
        foreach ($data as $value) {
            if (empty($value)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Formats a variable as a string representation.
     *
     * @param mixed $var The variable to format.
     * @return string The string representation of the variable.
     */
    public static function format_var($var) {
        switch (gettype($var)) {
            case 'array':
                $formatted = implode(',', $var);
                break;
            case 'object':
                $formatted = self::concatenateObjectMembers($var);
                break;
            case 'boolean':
                $formatted = $var ? 'true' : 'false';
                break;
            case 'NULL':
                $formatted = 'null';
                break;
            default:
                $formatted = (string) $var;
                break;
        }
        return $formatted;
    }

    /**
     * Concatenates the members of an object into a string.
     *
     * @param object $object The object whose members to concatenate.
     * @return string The concatenated string representation of the object members.
     */
    public static function concatenateObjectMembers($object) {
        $result = '';
        foreach ($object as $key => $value) {
            $result .= "$key: $value, ";
        }
        // Remove the trailing comma and space
        $result = rtrim($result, ', ');
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
     * @throws Exception If the chunk size is less than or equal to zero.
     */
    public static function makeChunks($data, $chunkSize) {
        // Check if the chunk size is valid
        if ($chunkSize <= 0) {
            throw new Exception('Chunk size must be greater than zero.');
        }

        // Divide the data array into chunks
        while (!empty($data)) {
            // Extract a chunk of the specified size from the data array
            $chunk = array_slice($data, 0, $chunkSize);

            // Log the chunk to the debug log
            Log::debug("Route array chunk: " . print_r($chunk, true));

            // Remove the chunk from the data array
            $data = array_slice($data, $chunkSize);
        }
    }
}
