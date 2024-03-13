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

}