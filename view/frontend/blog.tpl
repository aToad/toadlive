<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, minimum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>首页 | Toad's Blog</title>
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
            <li class="active"><a href="index.php">首页</a></li>
            <li><a href="title.php">列表</a></li>
            <li><a href="">关于</a></li>
        </ul>
    </nav>
    <div class="main">
        <div class="article-list">
            {foreach $articles(key, value)}
            <article id="{@key+1}">
                <h3 class="h3">
                    {@value->title}
                </h3>
                <aside class="expand">
                    展开全文...
                </aside>
                <div class="md">{@value->preview}</div>
                <footer class="article-footer">
                    <p>{@value->author} 发表于 {@value->posttime}</p>
                    <aside class="collapse">收起</aside>
                    <aside class="type">文章类别：{@value->type}</aside>
                </footer>

            </article>
            {/foreach}
            <div id="page">{$page}</div>
        </div>
        <div class="sidebar">
            <nav class="type">
                <h3 class="h3">博文分类</h3>
                <ul>
                   {foreach $types(key, value)}
                    <li>
                        <a href="?type={@value->id}">{@value->type}</a>
                        <span>{@value->size}</span>
                    </li>
                    {/foreach}
                </ul>
            </nav>
            <nav class="titles">
                <h3 class="h3">本页文章</h3>
                <ul>
                    {foreach $articles(key, value)}
                    <li><a href="#{@key+1}">{@value->title}</a></li>
                    {/foreach}
                </ul>
            </nav>
        </div>
    </div>
    <footer class="footer">
        <p>©2017 Toad </p>
        <p>UI借鉴：<a href="http://sleepycat.org/">闲逸笔记</a></p>
    </footer>
    <script src="../src/js/Toad.js" charset="utf-8"></script>
    <script src="../src/js/blog.js" charset="utf-8"></script>
</body>
</html>
