import TaskController from 'TaskController.js';
import View from 'views/View.js';

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
            t = TaskController.createTask(line, i);
        }
    }

    showDeleteSelect(arr) {

    }

    render() {
        document.addEventListener('DOMContentLoaded', function () {
            let calendarEl = document.getElementById('calendar');
            let calendar = new calendar.Calendar(calendarEl, {
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
    }

    removeDarkMode() {
        darkTheme = 'dark-theme'; // Your class name
        itemDivs = document.querySelectorAll('.dark-theme');
        // If dark theme is active, remove class names
        if(readCookie(darkTheme) === 'true'){
            itemDivs.forEach(itemDiv => {
                itemDiv.classList.remove(darkTheme);
            });
        }
    }

    readCookie(name) {
        const nameEQ = name + "=";
        const ca = document.cookie.split(';');
        for(let i=0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0)===' ') c = c.substring(1,c.length);
            if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length,c.length);
        }
        return null;
    }

    setConstants() {
        let requestCookie = HttpContext.Request.Cookies;
        let response = HttpContext.Response.Cookies;
        if (!requestCookie.ContainsKey("dark-theme"))
            response.Append("dark-theme","false");
        return View("Home");
    }
}