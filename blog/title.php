<?php

require substr(__DIR__, 0, -5) . "/config/config.php";

$view = new View();

$list = new ListModel();

# 分页
$page = new Page($list->getAllArticles(), 20);
$view->inject("articles", Tool::decodeHtmlString($list->getPageArticles($page->limit)));
$view->inject("page", $page->outputHTML());

# 博文分类
$view->inject("types", $list->getAllTypes());

$view->render("title.tpl");
