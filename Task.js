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

    createTask(line, i) {
        /* implementation here */
        line = line.split(',');
        if (line[0] = 'r') {
            if (utils.isNullOrNaN(line)) error = 1;
        else {
            //simple task
            if(utils.isNullOrNaN(line, 4, 8)) error = 1;
        }
        }
        t = new Task();
        if (error = 1) throw new Error('recurring task' + i + ' not completely filled.');
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

}