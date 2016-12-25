<?php

/**
 * Created by PhpStorm
 * User: Toad
 * Date: 2016/11/29
 * Time: 20:43.
 */
class ListModel extends Model
{

    private $id;

    public function __set($key, $value)
    {
         $this->$key = $value;
    }

    public function __get($key)
    {
        return $this->$key;
    }

    /**
     * 获得所有歌曲的数据
     * @return array 数组的每一项对应一首歌曲
     */
    public function getAllSongs()
    {
        $query = "SELECT id FROM ts.song";
        return parent::getAllLength($query);
    }

    // 删除一首歌曲
    public function removeOneSong()
    {
        $query = "DELETE FROM ts.song WHERE id = " . $this->id;
        return parent::adu($query);
    }

    /**
     * 获得所有图片的张数
     * @return int
     */
    public function getAllImages()
    {
        $query = "SELECT id FROM ts.bg";
        return parent::getAllLength($query);
    }

    public function getPageImages($limit)
    {
        $query = "SELECT * FROM ts.bg LIMIT $limit";
        return parent::getAll($query);
    }

    public function getPageSongs($limit)
    {
        $query = "SELECT * FROM ts.song LIMIT $limit";
        return parent::getAll($query);
    }

    public function getPageArticles($limit)
    {
        $query = "SELECT
                     a.title,
                     a.author,
                     t.type,
                     a.preview,
                     a.posttime
                 FROM
                     ts.article a,
                     ts.type t
                 WHERE
                     a.type = t.id
                 LIMIT $limit";
        return parent::getAll($query);
    }

    public function getTypeArticles($limit, $type)
    {
        $query = "SELECT
                     a.title,
                     a.author,
                     t.type,
                     a.preview,
                     a.posttime
                 FROM
                     ts.article a,
                     ts.type t
                 WHERE
                     a.type = $type && a.type = t.id
                 LIMIT $limit";
        return parent::getAll($query);
    }

    public function getTypeLength($type)
    {
        $query = "SELECT * FROM ts.article WHERE type = $type";
        return parent::getAllLength($query);
    }

    // 获得所有文章
    public function getAllArticles()
    {
        $query = "SELECT id FROM ts.article";
        return parent::getAllLength($query);
    }

    /**
     * 获得博文的所有类型
     * @return array 博文的所有类型
     */
    public function getAllTypes()
    {
        $query = "SELECT * FROM ts.type";
        return parent::getAll($query);
    }

}
