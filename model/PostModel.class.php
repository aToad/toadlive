<?php


class PostModel extends Model
{
    private $id;
    private $title;
    private $author;
    private $type;
    private $markdown;
    private $preview;

    public function __set($key, $value)
    {
         $this->$key = $value;
    }

    public function __get($key)
    {
        return $this->$key;
    }

    /**
     * 删除一篇文章
     * @return bool 是否删除成功
     */
    public function removeOneArticle()
    {
        $query = "DELETE FROM article WHERE id = " . $this->id;
        return parent::adu($query);
    }

    /**
     * 修改一篇文章
     * @return bool 是否修改成功
     */
    public function updateOneArticle()
    {
        $query = "UPDATE
                     article
                 SET
                     title = '$this->title',
                     author = '$this->author',
                     type = '$this->type',
                     markdown = '$this->markdown',
                     preview = '$this->preview',
                     posttime = NOW()
                WHERE
                    id = '$this->id'
                 ";
        return parent::adu($query);
    }

    /**
     * 获得一篇文章的数据
     * @return object 一篇文章
     */
    public function getOneArticle()
    {
        $query = "SELECT * FROM article WHERE id = '$this->id' LIMIT 1";
        return parent::getOne($query);
    }

    /**
     * 新增文章的类型是否存在
     * @return bool
     */
    public function isType()
    {
        $query = "SELECT id FROM type WHERE id='$this->type' LIMIT 1";
        return parent::isOne($query);
    }

    /**
     * 新增一篇某类文章
     * @return bool 是否更新成功
     */
    public function updateOneType()
    {
        $query = "UPDATE type SET size = size + 1 WHERE id = '$this->type'";
        return parent::adu($query);
    }

    // 发表一篇文章
    public function postOneArticle()
    {
        $query = "INSERT INTO article (
                      title,
                      author,
                      type,
                      markdown,
                      preview,
                      posttime
                  ) VALUES (
                      '$this->title',
                      '$this->author',
                      '$this->type',
                      '$this->markdown',
                      '$this->preview',
                      NOW()
                  )";
        return parent::adu($query);
    }

}
