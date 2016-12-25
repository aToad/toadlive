<?php

/**
 *
 */
class Page
{
    /**
     * 数据总条数
     * @var int
     */
    private $rows;

    /**
     * 每页显示的条数
     * @var int
     */
    private $size;

    /**
     * HTML
     * @var string
     */
    private $html;

    /**
     * mysql查询字符串
     * @var string
     */
    public $limit;

    /**
     * 分页总数
     * @var int
     */
    private $pages;

    /**
     * 当前页码
     * @var int
     */
    private $page;

    /**
     * 每页开始的索引
     * @var [type]
     */
    private $index;

    /**
     * url
     * @var [type]
     */
    private $url;

    /**
     * 当前页左右两边显示的分页个数
     * @var int
     */
    private $offset = 2;


    public function __construct($rows, $size)
    {
        $this->rows = $rows;
        $this->pages = ceil($rows/$size);
        $this->page = $this->getCurrentPage();
        $this->index = ($this->page - 1) * $size;
        $this->limit = "$this->index,$size";
        $this->url = $this->getURL();
    }

    private function getCurrentPage()
    {
        if (isset($_GET["page"]) && is_int(intval($_GET["page"]))) {
            if ($_GET["page"] < 1) {
                return 1;
            } else if ($_GET["page"] > $this->pages) {
                return $this->pages;
            } else {
                return intval($_GET["page"]);
            }
        } else {
            return  1;
        }
    }

    private function getURL()
    {
        $url = $_SERVER["REQUEST_URI"];
        $array = parse_url($url);
        if (isset($array["query"])) {
            parse_str($array["query"], $arrstr);
            unset($arrstr["page"]);
            $url = $array["path"] . "?" . http_build_query($arrstr) . "&";
        } else {
            $url = $array["path"] . "?";
        }
        return $url;
    }

    private function firstPage()
    {
        $this->html = '<a href="' . $this->url . 'page=1">1</a>';
    }

    private function prevPage()
    {
        if ($this->page <= 1) {
            $this->html .= '<a href="javascript:void(0)">&lt;&lt;</a>';
        } else {
            $prev = $this->page - 1;
            $this->html .= '<a href="' . $this->url . 'page=' . $prev . '">&lt;&lt;</a>';
        }
    }

    private function numPage()
    {
        for ($i=$this->offset; $i > 0; $i--) {
            $offsetPage = $this->page - $i;
            if ($offsetPage < 1) continue;
            $this->html .= '<a href="' . $this->url . 'page=' . $offsetPage . '">'. $offsetPage .'</a>';
        }
        $this->html .= '<a class="active" href="' . $this->url . 'page=' . $this->page . '">' . $this->page . '</a>';
        for ($i=1; $i <= $this->offset; $i++) {
            $offsetPage = $this->page + $i;
            if ($offsetPage > $this->pages) continue;
            $this->html .= '<a href="' . $this->url . 'page=' . $offsetPage . '">'. $offsetPage .'</a>';
        }
    }

    private function nextPage()
    {
        if ($this->page >= $this->pages) {
            $this->html .= '<a href="javascript:void(0)">&gt;&gt;</a>';
        } else {
            $this->html .= '<a href="' . $this->url . 'page=' . ($this->page + 1) . '">&gt;&gt;</a>';
        }
    }

    private function lastPage()
    {
        $this->html .= '<a href="' . $this->url . 'page=' . $this->pages . '">' . $this->pages .'</a>';
    }

    public function outputHTML()
    {
        $this->firstPage();
        $this->prevPage();
        $this->numPage();
        $this->nextPage();
        $this->lastPage();
        $this->getURL();
        return $this->html;
    }
}
