/**
 * Calendar.js
 * Main calendar class
 */

export default class Calendar {

    constructor() {
    }

    /**
     * Imports calendar tasks from a CSV file
     * @param {string} path - path of the CSV line 
     */
    importEntriesFromCSV(path) {
        if(!File.exists(path)) throw new FileNotFoundError('The specified file ' + path + 'could not be found');
        tasks = new Array(path.lines.length);
        line = path.readLine();
        while (line != null) {
            tasks.add(line);
        }
        for (i = 0;i < tasks.length; i++) {
            t = createTask(line, i);
        }
    }

}