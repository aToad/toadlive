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
        $query = "SELECT id FROM song";
        return parent::getAllLength($query);
    }

    // 删除一首歌曲
    public function removeOneSong()
    {
        $query = "DELETE FROM song WHERE id = " . $this->id;
        return parent::adu($query);
    }

    /**
     * 获得所有图片的张数
     * @return int
     */
    public function getAllImages()
    {
        $query = "SELECT id FROM bg";
        return parent::getAllLength($query);
    }

    /**
     * 分页显示的图片
     * @param  string $limit 查询字符串
     * @return array        多张图片
     */
    public function getPageImages($limit)
    {
        $query = "SELECT * FROM bg LIMIT $limit";
        return parent::getAll($query);
    }

    /**
     * 分页显示的歌曲
     * @param  string $limit 查询字符串
     * @return array        多首歌曲
     */
    public function getPageSongs($limit)
    {
        $query = "SELECT * FROM song LIMIT $limit";
        return parent::getAll($query);
    }

    /**
     * 分页显示的文章
     * @param  string $limit 查询字符串
     * @return array         多篇文章
     */
    public function getPageArticles($limit)
    {
        $query = "SELECT
                     a.id,
                     a.title,
                     a.author,
                     t.type,
                     a.preview,
                     a.posttime
                 FROM
                     article a,
                     type t
                 WHERE
                     a.type = t.id
                 ORDER BY
                     a.posttime DESC
                 LIMIT $limit";
        return parent::getAll($query);
    }

    /**
     * 分类显示文章
     * @param  string $limit 查询字符串
     * @param  int $type  代表类别的整数
     * @return array         多篇文章
     */
    public function getTypeArticles($limit, $type)
    {
        $query = "SELECT
                     a.title,
                     a.author,
                     t.type,
                     a.preview,
                     a.posttime
                 FROM
                     article a,
                     type t
                 WHERE
                     a.type = $type && a.type = t.id
                 LIMIT $limit";
        return parent::getAll($query);
    }

    /**
     * 某类文章的总数
     * @param  int $type 表示类型的整数
     * @return int  文章总数
     */
    public function getTypeLength($type)
    {
        $query = "SELECT * FROM article WHERE type = $type";
        return parent::getAllLength($query);
    }

    /**
     * 文章总数
     * @return int
     */
    public function getAllArticles()
    {
        $query = "SELECT id FROM article";
        return parent::getAllLength($query);
    }

    /**
     * 获得博文的所有类型
     * @return array 博文的所有类型
     */
    public function getAllTypes()
    {
        $query = "SELECT * FROM type";
        return parent::getAll($query);
    }

}
