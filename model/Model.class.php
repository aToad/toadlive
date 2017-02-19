<?php

/**
 * Created by PhpStorm
 * User: Toad
 * Date: 2016/11/27
 * Time: 10:26.
 */
class Model {

    /**
     * 从数据库中获得一行数据
     * @param  string $query mysql查询字符串
     * @return object  包含该条数据的对象
     */
    public function getOne($query)
    {
        $db = DB::getDB();
        $result = $db->query($query);
        $row = $result->fetch_object();
        $db->close();
        $result->free();
        $db = null;
        $result = null;
        return $row;
    }

    /**
     * 数据库中是否存在该条数据
     * @param  string  $query mysql查询字符串
     * @return int 1
     */
    public function isOne($query)
    {
        $db = DB::getDB();
        $db->query($query);
        $row = $db->affected_rows;
        $db->close();
        $db = null;
        return $row;
    }

    /**
     * 获得所有的查询到的行
     * @param  string $query mysql查询字符串
     * @return array  数组的一项都为对象，对象包含着数据库表中某一行中的所需字段
     */
    public function getAll($query)
    {
        $db = DB::getDB();
        $result = $db->query($query);
        while (!! $row = $result->fetch_object()) {
            $rows[] = $row;
        }
        $db->close();
        $db = null;
        $result->free();
        $result = null;
        return $rows;
    }

    /**
     * 获得数据的总行数
     * @param  string $query 查询字符串
     * @return int
     */
    public function getAllLength($query)
    {
        $db = DB::getDB();
        if ($db->query($query)) {
            $rows = $db->affected_rows;
            $db->close();
            $db = null;
            return $rows;
        } else {
            Tool::alertBack("查询失败！");
        }

    }

    /**
     * 增删改一行数据
     * @param  string $query mysql查询字符串
     * @return bool        布尔值
     */
    public function adu($query)
    {
        $db = DB::getDB();
        $result = $db->query($query);
        $db->close();
        if ($result) {
            return $result;
        } else {
            Tool::alertBack("查询失败！");
        }
    }

    public function getMaxId($table) 
    {
        $db = DB::getDB();
        $result = $db->query("SELECT max(id) From " . $table);
        $db->close();
        return $result;
    }

}
