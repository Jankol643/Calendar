<?php

namespace App\Http\Controllers\Helpers;

use Illuminate\Support\Facades\Request;
use DateTime;
use Illuminate\Http\Request as HttpRequest;

class StringHelper {

    /**
     * Checks if a string contains any forbidden characters.
     *
     * @param string $string The string to check.
     * @param array $forbiddenCharacters An array of forbidden characters.
     *
     * @return bool Returns true if the string contains any forbidden characters, false otherwise.
     *
     * @throws Exception If the forbiddenCharacters parameter is not an array.
     */
    public static function checkStringCharacters(string $string, array $forbiddenCharacters) {
        // Check if any forbidden characters are present in the string
        foreach ($forbiddenCharacters as $char) {
            if (strpos($string, $char) !== false) {
                return true;
            }
        }
        return false;
    }

    /**
     * Capitalizes the first letter of each word in a given string.
     *
     * @param string $string The input string.
     * @return string The capitalized string.
     */
    public static function capitalizeWords(string $string): string {
        // Split the string into an array of words
        $words = explode(' ', $string);

        // Capitalize the first letter of each word
        $capitalizedWords = array_map(function ($word) {
            return ucfirst($word);
        }, $words);

        // Join the capitalized words back into a string
        $capitalizedString = implode(' ', $capitalizedWords);

        return $capitalizedString;
    }

    /**
     * Generates a random string of specified length.
     *
     * @param int $length The length of the random string to generate. Default is 10.
     * @return string The generated random string.
     *
     * @throws Random\RandomException If the source of randomness is not available.
     */
    public static function generateRandomString(int $length = 10): string {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    /**
     * Finds the position of the nth occurrence of a character in a string.
     *
     * @param string $searchString The string to search in.
     * @param string $character The character to search for.
     * @param int $n The occurrence number to find.
     *
     * @return int|false The position of the nth occurrence of the character in the string, or false if not found.
     */
    public static function getNthOccurrence($searchString, $character, $n) {
        $occurrences = 0;

        for ($i = 0; $i < strlen($searchString); $i++) {
            if ($searchString[$i] === $character) {
                $occurrences++;
                if ($occurrences === $n) {
                    return $i;
                }
            }
        }
        return false;
    }

    /**
     * Converts a request into URL parameters.
     *
     * @param array $request The request data.
     *
     * @return string The URL parameters.
     */
    public static function convertRequestToUrlParameters($request) {
        // Use http_build_query to convert the request into URL parameters
        $urlParameters = http_build_query($request);

        // Return the URL parameters
        return $urlParameters;
    }
}
