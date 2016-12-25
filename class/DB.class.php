<?php

/**
 * Created by PhpStorm
 * User: Toad
 * Date: 2016/11/27
 * Time: 10:20.
 */
class DB {
    public static function getDB()
    {
        $mysqli = new mysqli("localhost", "root", "root", "ts");
        if (mysqli_connect_errno()) {
            Tool::alertBack("连接数据库服务器失败：" . mysqli_connect_error());
        }
        return $mysqli;
    }

    public static function mysqlEscapeString($query) {
        $mysqli = DB::getDB();
        return $mysqli->real_escape_string($query);
    }

}
