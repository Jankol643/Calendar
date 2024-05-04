document.addEventListener('DOMContentLoaded', function () {
	let calendarEl = document.getElementById('calendar');
	let calendar = new FullCalendar.Calendar(calendarEl, {
		initialView: 'dayGridMonth',
		initialDate: '2024-03-07',
		headerToolbar: {
			left: 'prev,next today',
			center: 'title',
			right: 'dayGridMonth,timeGridWeek,timeGridDay'
		},
		events: 'events.json'
	});
	calendar.render();
});

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
        if (!File.exists(path)) throw new FileNotFoundError('The specified file ' + path + 'could not be found');
        tasks = new Array(path.lines.length);
        line = path.readLine();
        while (line != null) {
            tasks.add(line);
        }
        for (i = 0; i < tasks.length; i++) {
            t = createTask(line, i);
        }
    }

    showDeleteSelect(arr) {

    }

}