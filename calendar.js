/**
 * Calendar.js
 * Main calendar class
 */

export default class Calendar {

    constructor(maxEntryDate) {
        this.maxEntryDate = maxEntryDate;
    }

    /**
     * Imports calendar tasks from a CSV file
     * @param {string} path - path of the CSV line 
     */
    importEntriesFromCSV(path) {
        if(!File.exists(path)) throw new FileNotFoundError('The specified file ' + path + 'could not be found');
        tasks = new Array(path.lines.length + 1);
        line = path.readLine();
        while (line != null) {
            tasks.add(line);
        }
        for (i = 0 to tasks.length) {
            t = createTask(line, i);
        }
    }

}