<?php

namespace App\Http\Controllers\Helpers;

class Util
{
    /**
     * Checks if a server file exists, is not empty and has the specified extension
     * @param {string} path - path to the file
     * @param {string} ext - file extension 
     */
    function FileOK($path, $ext)
    {
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
     * @param {string} path - path to the file
     * @returns string - file extension
     */
    static function getExtension($path)
    {
        $basename = basename($path);
        $pos = strrpos($basename, ".");
        if ($basename === "" || $pos === false || $pos === 0) {
            return "";
        }
        return substr($basename, $pos + 1);
    }

    /**
     * Checks if an array is null or any of its values are null or NaN
     * @param {*} arr - array to check
     * @param {*} from - lower limit to check - 0 if omitted
     * @param {*} to - upper limit to check - length of array if omitted
     * @returns bool - true if the array is null or contains null or NaN values
     */
    static function isNullOrUndefined($arr, $from = 0, $to = null)
    {
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
     * @param {string} line - line to check
     * @returns bool - true if the line is complete
     */
    function isLineComplete($line)
    {
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
     * Adds a specific number of months to a date
     * @param {Date} date - date to add months to
     * @param {*} months - number of months to add
     * @returns Date - date with months added
     */
    function addMonths($date, $months)
    {
        $day = $date->format('d');
        $date->modify("+$months months");
        if ($date->format('d') != $day) {
            $date->modify('last day of previous month');
        }
        return $date;
    }

    public function toSQLArray($obj)
    {
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

    public function insertStrIntoArr($str, $arr)
    {
        $cnt = 0;
        foreach ($arr as $item) {
            array_splice($arr, $cnt, 0, $str);
            $cnt++;
        }
        return $arr;
    }

    public static function FormToString($data)
    {
    }

    public static function isFormComplete($data) {
        
    }
}
