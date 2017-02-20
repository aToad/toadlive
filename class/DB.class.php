<?php

class DB {

    public static function getDB()
    {
        $mysqli = new mysqli("bdm249404492.my3w.com", "bdm249404492", "toMySwan930518", "bdm249404492_db");
    //    $mysqli = new mysqli("localhost", "root", "root", "ts");
        if (mysqli_connect_errno()) {
            Tool::alertBack("连接数据库服务器失败：" . mysqli_connect_error());
        }
        $mysqli->query("SET NAMES UTF8");
        return $mysqli;
    }

    public static function mysqlEscapeString($query) {
        $mysqli = DB::getDB();
        return $mysqli->real_escape_string($query);
    }

}
