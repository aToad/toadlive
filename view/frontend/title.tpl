<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, minimum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>博文列表 | Toad's Blog</title>
    <link rel="stylesheet" href="../static/highlight/styles/atom-one-dark.css">
    <script src="../static/highlight/highlight.pack.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
    <link rel="stylesheet" href="../static/css/blog.min.css">
</head>
<body class="ts">
    <header class="header">
        <figure>
            <img src="../static/img/Toad.png" alt="">
            <figcaption>
                <h1>Toad's Blog</h1>
                <p>Be a toad, to seek your swan.</p>
            </figcaption>
        </figure>
    </header>
    <nav class="nav">
        <ul class="nav-list">
            <li><a href="../index.php">Home</a></li>
            <li><a href="index.php">首页</a></li>
            <li class="active"><a href="title.php">列表</a></li>
            <li><a href="">关于</a></li>
        </ul>
    </nav>
    <div class="main">
        <div class="article-list">
            <ul class="title-list">
                {foreach $articles(key, value)}
                <li><a href="">{@value->title}</a></li>
                {/foreach}
            </ul>
            <div id="page">{$page}</div>
        </div>
        <div class="sidebar">
            <nav class="type">
                <h3 class="h3">博文分类</h3>
                <ul>
                   {foreach $types(key, value)}
                    <li>
                        <a href="">{@value->type}</a>
                        <span>{@value->size}</span>
                    </li>
                    {/foreach}
                </ul>
            </nav>
        </div>
    </div>
    <footer class="footer">
        <p>©2017 Toad </p>
        <p>UI借鉴：<a href="http://sleepycat.org/">闲逸笔记</a></p>
    </footer>
</body>
</html>
