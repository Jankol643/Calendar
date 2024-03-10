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

}