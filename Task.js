/** Task.js
 * This Task class represents a calendar task with following parameters:
*/

import * as utils from 'util.js';

export default class Task {
    /**
     * 
     * @param {int} id - a unique identifier for the task
     * @param {boolean} recurr - a boolean indicating whether the task recurs or not
     * @param {int} freq_no - the frequency duration for recurring tasks
     * @param {int} freq_dur - how long the task should be executed
     * @param {Date} last_exec - the last execution date for recurring tasks
     * @param {Date} due_date - the date when the task is due
     * @param {string} task_cat - the category of the task
     * @param {string} task_name - the name of the task
     * @param {string} task_descr - a description of the task
     * @param {int} task_dur - the duration of the task
     * @param {int} prio - the priority of the task
     */
    constructor(id, recurr, freq_no, freq_dur, last_exec, due_date, task_cat, task_name, task_descr, task_dur, prio) {
        this.id = id;
        this.recurr = recurr;
        this.freq_no = freq_no;
        this.freq_dur = freq_dur;
        this.last_exec = last_exec;
        this.due_date = due_date;
        this.task_cat = task_cat;
        this.task_name = task_name;
        this.task_descr = task_descr;
        this.task_dur = task_dur;
        this.prio = prio;
    }

    /**
     * Creates task from a specified line
     * @param {string|Array} line - line with task information
     * @param {int} i - task number
     * @returns {Task} t - created task
     */
    createTask(line, i) {
        if(typeof(line) === String) line = line.split(',');
        if (line[0] = 'r') {
            if (utils.isNullOrNaN(line)) error = 1;
            else {
                //simple task
                if (utils.isNullOrNaN(line, 4, 8)) error = 1;
            }
        }
        if (error = 1) throw new Error('recurring task' + i + ' not completely filled.');
        t = new Task();
        //save task in DB
        return t;
    }

    updateTask() {
        /* implementation here */
    }
    deleteTask() {
        /* implementation here */
    }
    findBy(searchCriteria, searchTerm) {
        /* implementation here */
    }

    /**
     * Returns all tasks in the DB
     * @returns {Array} tasks - all tasks currently saved in the DB
     */
    fetchAll() {

    }

    /**
     * Fetches all tasks with a due date in the specified date range
     * @param {Date} startDate - start date to check
     * @param {*} endDate - start date to check
     * @returns {Array} taskList - array with found tasks
     */
    listTasksByDate(startDate, endDate) {
        db = DB.getConnection();
        len = db.tasks.length;
        taskList = new Array(len);
        for (i = 0; i < len; i++) {
            current = db.getNextTask();
            if (current.due_date >= startDate && current.due_date <= endDate)
                taskList[len] = current;
        }
        return taskList;
    }

    /**
     * Generates a series of recurring tasks until the target date
     * @param {Date} targetDate - last occurence of recurring task
     */
    generateTasksUntilDate(targetDate) {

    }
    
    /**
     * Generates a series of tasks with the specified number of items
     * @param {int} frequency - number of tasks
     */
    generateTasksUntilFreq(frequency) {

    }

}