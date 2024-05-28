export class Util {
    toSQLArray(obj) {
        arr = [];
        cnt = 0;
        for (let prop in obj) {
            if (!obj.hasOwnProperty(prop)) continue;
            arr[cnt] = prop;
            cnt++;
        }
        arr = this.insertStrIntoArr(", ", arr);
    }

    insertStrIntoArr(str, arr) {
        cnt = 0
        for(item in arr) {
            arr.splice(item.index, 0, str);
        }
        return arr;
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
}