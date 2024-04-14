/** Task.js
 * This Task class represents a calendar task with following parameters:
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

import * as utils from 'util.js';
import * as calendar from 'calendar.js';

export default class Task {
    /**
     * Initialises a new task
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
        if (typeof (line) === String) line = line.split(',');
        if (line[0] = 'r') {
            if (utils.isNullOrNaN(line)) error = 1;
            else {
                //simple task
                if (utils.isNullOrNaN(line, 4, 8)) error = 1;
            }
        }
        if (error = 1) throw new Error('recurring task' + i + ' not completely filled.');
        t = new Task(i, int(line[0]), int(line[1]), int(line[3]), Date(line[4]), Date(line[5]), line[6], line[7], line[8], line[9], line[10]);
        t.save();
        return t;
    }

    save() {

    }

    addTaskFromForm($_POST) {
        if (isFormComplete($_POST)) {
            task = this.createTask(FormToString($_POST), $_POST['task_no']);
            redirectToPage('success', 'Task' + task.id + ' successfully created');
        }
        else throw new Error('Task ' + $_POST['task_no'] + 'could not be created.');
    }

    saveRecurringTask(task) {
        if (task.due_date < new Date()) return new Error(
            'Cannot save historic task ' + task_id + ' with name ' + task.task_name + ' and due date ' + task.due_date);
        for (i = 1; i <= task.freq_no; i++) {
            ce = new Task(task.id, true, task.freq_no, task.freq_dur, task.last_exec, task.due_date, task.task_cat, task.task_name, task.task_descr, task.task_dur, task.prio);
            ce.save();
        }
    }

    updateTask() {
        /* implementation here */
    }
    deleteTask() {
        /* implementation here */
        toastr.message('Task ' + this.task_name + ' successfully deleted.');
    }

    deleteTaskByNameDate(taskName, dueDate) {
        tasks = this.fetchAll();
        if (tasks != null && tasks.length > 0) {
            res1 = this.findBy('name', taskName);
            if (res1 != null && res1.length > 0) {
                res2 = this.findInTaskList(res1, 'due_date', dueDate);
                if (res2.length === 0) res2[0].deleteTask();
                else calendar.showDeleteSelect(res2);
            }
        }
    }

    findBy(searchCriteria, searchTerm) {
        /* implementation here */
    }

    findInTaskList(taskList, searchCriteria, searchTerm) {

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

    writeToCSV(task_list, path) {
        db = utils.openDB();
        file = File.open(path);
        if (file) {
            for (row in db)
                if (row.id in task_list) file.write(row + '\n');
            toastr.message('Tasks successfully written to file' + path);
        }
        else return new Error('File ' + path + ' is corrupt. Writing to CSV aborted.');
    }

}