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
        if (arr === (null || undefined)) return true;
        if (to === undefined) to = arr.length;
        for (i = from; i <= to; i++) {
            if (arr(i) === (null || undefined)) return true;
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

    //https://stackoverflow.com/a/12793246+
    //TODO: correct using comments
    addMonths(date, months) {
        let d = date.getDate();
        date.setMonth(date.getMonth() + +months);
        if (date.getDate() != d) {
          date.setDate(0);
        }
        return date;
      
      // Add 12 months to 29 Feb 2016 -> 28 Feb 2017
      console.log(addMonths(new Date(2016,1,29),12).toString());
      
      // Subtract 1 month from 1 Jan 2017 -> 1 Dec 2016
      console.log(addMonths(new Date(2017,0,1),-1).toString());
      
      // Subtract 2 months from 31 Jan 2017 -> 30 Nov 2016
      console.log(addMonths(new Date(2017,0,31),-2).toString());
      
      // Add 2 months to 31 Dec 2016 -> 28 Feb 2017
      console.log(addMonths(new Date(2016,11,31),2).toString());
    }

    openDB() {
        connectStr = File.read('settings.json');
        db = DB.open(connectStr);
        if (db) return db;
        else return new Error('Connection error: ' + Error.message);
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
        con = this.calculateColorContrast(color1, color2);
        res = 0;
        if (type = 'text') {
            if (standard = 'AA') {
                if (fontSize < 14) {
                    if (con > 4.5) res = 1;
                }
                else {
                    if (con > 3) res = 1;
                }
            } else {
                //standard = 'AAA'
                if (fontSize < 14) {
                    if (con > 7) res = 1;
                }
                else {
                    if (con > 4.5) res = 1;
                }
            }
        }
        else {
            //graphics and user interface components
            if (con > 3) res = 1;
        }

        if (res == 1) return true;
        return false;
    }

    /**
     * Calculates the contrast between two colors
     * @param {string} color1 - color code of first color in hexadecimal
     * @param {string} color2 - color code of second color in hexadecimal
     * @returns contrast of the two colors as decimal number
     */
    calculateColorContrast(color1, color2) {
        contrast = 1;
        if(typeof(color1) === String || typeof(color2) === String) {
            color1 = this.hexToRGB(color1);
            color2 = this.hexToRGB(color2);
            let color1 = color1.map(function(e) { 
                e= e / 255;
                return e;
              });
            let color2 = color2.map(function(e) { 
                e= e / 255;
                return e;
              });
            relLumCol1 = this.calculateRelLuminance(color1);
            relLumCol2 = this.calculateRelLuminance(color2);
            contrast = (relLumCol1 + 0.05) / (relLumCol2 + 0.05);
            return contrast;
        } 
        
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
            // validation input
            if (values[i] < 0 || values[i] > 255) throw new Error('An each value of RGB format must be ranges from 0 to 255');

            // append to result values as hex with at least width 2
            result += (('0' + values[i].toString(16)).slice(-2));
        }
        return result.toUpperCase();
    };


    /**
     * Convert a value from the hex format to RGB and return as an array
     * @param  {int} value A color`s value in the hex format
     * @return {array}     Array values of the RGB format
     */
    hexToRGB(value) {
        let val = value;
        val = (value[0] === '#') ? value.slice(1) : value;
        if ([3, 6].indexOf(val.length) === -1) throw new Error(`Incorect a value of the hex format: ${value}`);
        if (val.length === 3) val = val.split('').map(item => item.repeat(2)).join('');
        return val.match(/.{2}/g).map(item => parseInt(`0x${item}`, 16));
    };

    /**
     * Calculates the relative luminance of a color
     * @param {Array[int]} color Array values of the RGB format
     * @param {string} standard standard to check
     * @returns 
     */
    calculateRelLuminance(color, standard) {
        relLum = 0;
        colVals = [3];
        thresholdIEC = 0.04045; //correct
        thresholdWCAG = 0.03928; //incorrect, but in WCAG standard
        for (i = 0; i <= 3; i++) {
            if (standard === 'WCAG') threshold = thresholdWCAG;
            else threshold = thresholdIEC;
            if (color[i] <= thresholdWCAG) colVals[i] = color[i] / 12.92;
            else colVals[i] = Math.pow((color[i] + 0.055) / 1.055, 2.4);
        }
        relLum = 0.2126 * R + 0.7152 * G + 0.0722 * B;
        return relLum;
    }

}