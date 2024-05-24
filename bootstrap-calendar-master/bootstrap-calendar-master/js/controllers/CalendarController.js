/**
 * Calendar.js
 * Main calendar class
 */

import TaskController from 'TaskController.js';

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

    async connectToDB() {
        const mariadb = require('mariadb');
        const pool = mariadb.createPool({
            host: 'localhost',
            user: 'root',
            password: '',
            connectionLimit: 5
        });
        try {
            return await pool.getConnection();
        } catch (err) {
            throw err;
        }
    }

    async asyncFunction() {
        con = this.connectToDB();
        if (con) {
            const rows = await conn.query("IF OBJECT_ID(N'dbo.Calendar-items', N'U') IS NULL BEGIN   CREATE TABLE dbo.Calendar-items (Name varchar(64) not null)");
            console.log(rows); //[ {val: 1}, meta: ... ]
            const res = await conn.query("INSERT INTO myTable value (?, ?)", [1, "mariadb"]);
            console.log(res); // { affectedRows: 1, insertId: 1, warningStatus: 0 }
        }
    }

}