<?php

/**
 * Created by PhpStorm
 * User: Toad
 * Date: 2016/11/29
 * Time: 7:46.
 */
class UploadModel extends Model{
    private $title;
    private $singer;
    private $album;
    private $src;
    private $ext;
    private $author;
    private $link;

    public function __set($key, $value)
    {
        $this->$key = $value;
    }

    public function __get($key)
    {
        return $this->$key;
    }

    public function uploadOneSong()
    {
        $query = "INSERT INTO song (
                      title,
                      singer,
                      album,
                      src
                 ) VALUES (
                      '$this->title',
                      '$this->singer',
                      '$this->album',
                      '$this->src'
                 )";
        return parent::adu($query);
    }

    public function uploadOneImage()
    {
        $query = "INSERT INTO bg (
                      title,
                      author,
                      link,
                      ext,
                      src
                 ) VALUES (
                      '$this->title',
                      '$this->author',
                      '$this->link',
                      '$this->ext',
                      '$this->src'
                 )";
        return parent::adu($query);
    }
}
