export default class Util {

    /**
     * Checks if a server file exists, is not empty and has the specified extension
     * @param {string} path - path to the file
     * @param {string} ext - file extension 
     */
    FileOK(path, ext) {
        path += "?" + new Date().getTime() + Math.floor(Math.random() * 1000000);
        let file = new File(path);
        if (file.exists()) {
            let request = require("request");

            request({
                url: "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/core.js",
                method: "HEAD"
            }, function (err, response, body) {
                console.log(response.headers);
                process.exit(0);
            });
        }
    }

    getExtension(path) {
        let basename = path.split(/[\\/]/).pop(),  // extract file name from full path ...
            // (supports `\\` and `/` separators)
            pos = basename.lastIndexOf(".");           // get last position of `.`
        if (basename === "" || pos < 1)            // if file name is empty or ...
            return "";                             //  `.` not found (-1) or comes first (0)
        return basename.slice(pos + 1);            // extract extension ignoring `.`
    }

    /**
     * Checks if a array is or any of its values are null or NaN
     * @param {*} arr - array to check
     * @param {*} from - lower limit to check - 0 if omitted
     * @param {*} to - upper limit to check - length of array if omitted
     */
    isNullOrUndefined(arr, from = 0, to) {
        if (!arr) return true;
        if (to === undefined) to = arr.length;
        for (let i = from; i <= to; i++) {
            if (!arr[i]) return true;
        }
        return false;
    }

    /**
     * Checks if a line is complete
     * @param {string} line - line to check
     * @returns bool - true if line is complete
     */
    isLineComplete(line) {
        splitted = line.split(',');
        if (splitted.length != 8) return false;
        if (splitted[0] = 1) {
            if (this.isNullOrUndefined(splitted, 1, 1) = false) return false;
            if (this.isNullOrUndefined(splitted, 3, 7) = false) return false;
            return true;
        }
    }

    /**
     * Adds a specific number of months to a date
     * @param {Date} date - date to add months to
     * @param {*} months - number of months to add
     * @returns date - date with months added
     */
    addMonths(date, months) {
        let d = date.getDate();
        date.setMonth(date.getMonth() + Number(months));
        if (date.getDate() != d)
            date.setDate(0);
        return date;
    }

    /**
     * Checks the color contrast of two colors
     * @param {string} color1 hexadecimal code of color 1
     * @param {string} color2 hexadecimal code of color 2
     * @param {string} type type of element to check (text or null meaning graphics or UI components)
     * @param {int} fontSize font size of text if applicable
     * @param {string} standard WCAG standard to check against (AA or AAA)
     * @returns true if color contrast conforms with the given standard
     */
    checkColorContrast(color1, color2, type, fontSize, standard) {
        const con = this.calculateColorContrast(color1, color2);
        let res = 0;

        if (type === 'text') {
            if ((standard === 'AA' && fontSize < 14 && con > 4.5) ||
                (standard === 'AA' && fontSize >= 14 && con > 3) ||
                (standard === 'AAA' && fontSize < 14 && con > 7) ||
                (standard === 'AAA' && fontSize >= 14 && con > 4.5)) {
                res = 1;
            }
        } else {
            if (con > 3) {
                //graphics and user interface components
                res = 1;
            }
        }
        return res === 1;
    }

    /**
     * Calculates the contrast between two colors
     * @param {string} color1 - color code of first color in hexadecimal
     * @param {string} color2 - color code of second color in hexadecimal
     * @returns contrast of the two colors as decimal number
     */
    calculateColorContrast(color1, color2) {
        let contrast = 1;
        if (typeof (color1) === 'string' || typeof (color2) === 'string') {
            color1 = this.hexToRGB(color1).map(e => e / 255);
            color2 = this.hexToRGB(color2).map(e => e / 255);
            relLumCol1 = this.calculateRelLuminance(color1);
            relLumCol2 = this.calculateRelLuminance(color2);
            contrast = (relLumCol1 + 0.05) / (relLumCol2 + 0.05);
        }
        return contrast;
    }

    /**
     * Return a color`s value in the hex format by passed the RGB format.
     * @param  {integer} value1 An value in ranges from 0 to 255
     * @param  {integer} value2 An value in ranges from 0 to 255
     * @param  {integer} value3 An value in ranges from 0 to 255
     * @return {string}        A color`s value in the hex format
     */
    RGBtoHex(value1, value2, value3) {
        const values = [value1, value2, value3];
        let result = '#';
        for (let i = 0; i < 3; i += 1) {
            // input validation
            if (values[i] < 0 || values[i] > 255) throw new Error('An each value of RGB format must be ranges from 0 to 255');
            // append to result values as hex with at least width 2
            result += (('0' + values[i].toString(16)).slice(-2));
        }
        return result.toUpperCase();
    };


    /**
     * Convert a value from the hex format to RGB and return as an array
     * @param  {int} value A colors value in the hex format
     * @return {array}     Array values of the RGB format
     */
    hexToRGB(value) {
        let val = value;
        val = (value[0] === '#') ? value.slice(1) : value;
        if ([3, 6].indexOf(val.length) === -1) throw new Error(`Incorrect value of hex format: ${value}`);
        if (val.length === 3) val = val.split('').map(item => item.repeat(2)).join('');
        return val.match(/.{2}/g).map(item => parseInt(`0x${item}`, 16));
    };

    /**
     * Calculates the relative luminance of a color
     * @param {Array[int]} color Array values of the RGB format
     * @param {string} standard standard to check
     * @returns relative luminance
     */
    calculateRelLuminance(color, standard) {
        colVals = [3];
        thresholdIEC = 0.04045; //correct
        thresholdWCAG = 0.03928; //incorrect, but in WCAG standard
        for (i = 0; i <= 3; i++) {
            const threshold = (standard === 'WCAG') ? thresholdWCAG : thresholdIEC;
            if (color[i] <= threshold) {
                colVals[i] = color[i] / 12.92;
            } else {
                colVals[i] = Math.pow((color[i] + 0.055) / 1.055, 2.4);
            }
        }
        return 0.2126 * colVals[0] + 0.7152 * colVals[1] + 0.0722 * colVals[2];
    }

}