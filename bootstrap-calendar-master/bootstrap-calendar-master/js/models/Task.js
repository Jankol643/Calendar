import * as Util from 'Utility/util.js';

class Task {
    constructor() {

    }

    createTable(tasks) {
        query = `CREATE TABLE IF NOT EXISTS ` + tasks + `(
            id INT PRIMARY KEY,
            recurr BOOLEAN,
            freq_no INT,
            freq_dur VARCHAR(255),
            last_exec DATE,
            due_date DATE,
            task_cat VARCHAR(255),
            task_name VARCHAR(255),
            task_descr TEXT,
            task_dur INT,
            prio INT
        );`;
    }
    
    async asyncFunction() {
        con = await this.connectToDB();
        if (con) {
            const rows = await conn.query("CREATE TABLE IF NOT EXISTS dbo.Calendar-items (Name varchar(64) not null)");
            console.log(rows); //[ {val: 1}, meta: ... ]
            const res = await conn.query("INSERT INTO myTable value (?, ?)", [1, "mariadb"]);
            console.log(res); // { affectedRows: 1, insertId: 1, warningStatus: 0 }
        }
    }
    
    insert(task) {
        query = `INSERT INTO tasks (` + Util.toSQLArray(task) + `)`;
    }
}