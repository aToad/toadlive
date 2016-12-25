<?php

require substr(__DIR__, 0, -5) . "/config/config.php";

$view = new View();

$list = new ListModel();

# 博文分类
$view->inject("types", $list->getAllTypes());

if (isset($_GET["type"])) {
    $page = new Page($list->getTypeLength($_GET["type"]), PAGE_SIZE);
    $view->inject("articles", Tool::decodeHtmlString($list->getTypeArticles($page->limit, $_GET["type"])));
    $view->inject("page", $page->outputHTML());
} else {
    # 分页
    $page = new Page($list->getAllArticles(), PAGE_SIZE);
    $view->inject("articles", Tool::decodeHtmlString($list->getPageArticles($page->limit)));
    $view->inject("page", $page->outputHTML());
}


$view->render("blog.tpl");
