<?php

namespace App\Http\Controllers\Helpers;

class colorUtil {
/**
 * Checks the color contrast of two colors
 * @param {string} color1 - hexadecimal code of color 1
 * @param {string} color2 - hexadecimal code of color 2
 * @param {string} type - type of element to check (text or null meaning graphics or UI components)
 * @param {int} fontSize - font size of text if applicable
 * @param {string} standard - WCAG standard to check against (AA or AAA)
 * @returns bool - true if the color contrast conforms with the given standard
 */
function checkColorContrast($color1, $color2, $type, $fontSize, $standard) {
    $contrast = $this->calculateColorContrast($color1, $color2);
    $result = false;

    if ($type === 'text') {
        if (($standard === 'AA' && $fontSize < 14 && $contrast > 4.5) ||
            ($standard === 'AA' && $fontSize >= 14 && $contrast > 3) ||
            ($standard === 'AAA' && $fontSize < 14 && $contrast > 7) ||
            ($standard === 'AAA' && $fontSize >= 14 && $contrast > 4.5)) {
            $result = true;
        }
    } else {
        if ($contrast > 3) {
            // graphics and user interface components
            $result = true;
        }
    }
    return $result;
}

    /**
     * Calculates the contrast between two colors
     * @param string $color1 - color code of first color in hexadecimal
     * @param string $color2 - color code of second color in hexadecimal
     * @return float - contrast of the two colors as a decimal number
     */
    public function calculateColorContrast($color1, $color2) {
        $contrast = 1;
        if (is_string($color1) || is_string($color2)) {
            $color1 = $this->hexToRGB($color1);
            $color2 = $this->hexToRGB($color2);
            $relLumCol1 = $this->calculateRelLuminance($color1);
            $relLumCol2 = $this->calculateRelLuminance($color2);
            $contrast = ($relLumCol1 + 0.05) / ($relLumCol2 + 0.05);
        }
        return $contrast;
    }

    /**
     * Return a color's value in the hex format by passing the RGB format.
     * @param int $value1 - A value in the range from 0 to 255
     * @param int $value2 - A value in the range from 0 to 255
     * @param int $value3 - A value in the range from 0 to 255
     * @return string - A color's value in the hex format
     */
    public function RGBtoHex($value1, $value2, $value3) {
        $values = [$value1, $value2, $value3];
        $result = '#';
        foreach ($values as $value) {
            if ($value < 0 || $value > 255) {
                throw new Exception('Each value of RGB format must be in the range from 0 to 255');
            }
            $result .= str_pad(dechex($value), 2, '0', STR_PAD_LEFT);
        }
        return strtoupper($result);
    }

    /**
     * Convert a value from the hex format to RGB and return as an array
     * @param string $value - A color's value in the hex format
     * @return array - Array values of the RGB format
     */
    public function hexToRGB($value) {
        $val = $value;
        $val = ($value[0] === '#') ? substr($value, 1) : $value;
        if (!in_array(strlen($val), [3, 6])) {
            throw new Exception("Incorrect value of hex format: $value");
        }
        if (strlen($val) === 3) {
            $val = str_split($val);
            $val = array_map(function ($item) {
                return str_repeat($item, 2);
            }, $val);
            $val = implode('', $val);
        }
        return array_map(function ($item) {
            return hexdec("0x$item");
        }, str_split($val, 2));
    }

    /**
     * Calculates the relative luminance of a color
     * @param array $color - Array values of the RGB format
     * @param string $standard - Standard to check
     * @return float - Relative luminance
     */
    public function calculateRelLuminance($color, $standard = 'WCAG') {
        $colVals = [];
        $thresholdIEC = 0.04045;
        $thresholdWCAG = 0.03928;
        for ($i = 0; $i <= 3; $i++) {
            $threshold = ($standard === 'WCAG') ? $thresholdWCAG : $thresholdIEC;
            if ($color[$i] <= $threshold) {
                $colVals[$i] = $color[$i] / 12.92;
            } else {
                $colVals[$i] = pow(($color[$i] + 0.055) / 1.055, 2.4);
            }
        }
        return 0.2126 * $colVals[0] + 0.7152 * $colVals[1] + 0.0722 * $colVals[2];
    }
}