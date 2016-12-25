<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, minimum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>欢迎您的到访！</title>
    <link rel="stylesheet" href="../static/css/list.min.css">
</head>
<body class="ts">
<nav class="nav">
    <h1>Toad</h1>
    <ul>
        <li>
            <dl>
                <dt class="toggle">列表</dt>
                <dd><a href="list.php?action=music">歌曲列表</a></dd>
                <dd><a href="list.php?action=image">图片列表</a></dd>
                <dd><a href="list.php?action=article">文章列表</a></dd>
            </dl>
        </li>
        <li>
            <dl>
                <dt class="toggle">上传</dt>
                <dd><a href="upload.php?action=music">上传歌曲</a></dd>
                <dd><a href="upload.php?action=image">上传图片</a></dd>
            </dl>
        </li>
        <li>
            <dl>
                <dt class="toggle">发表</dt>
                <dd><a href="post.php?action=article">发表文章</a></dd>
                <dd><a href="post.php?action=lyric">发表歌词</a></dd>
            </dl>
        </li>
    </ul>
</nav>
<div class="main">
    <nav class="breadcrumb">
        <h2 class="admin">
            管理员：[ {$admin} ] ( <a href="logout.php">退出</a> )
        </h2>
        <ul>
            <li><a href="">Toad</a>/</li>
            <li><a href="">列表</a>/</li>
            <li><a href="">{$list}</a></li>
        </ul>
    </nav>
    {if $music}
        <table class="list">
            <thead>
                <tr>
                    <th>编号</th>
                    <th>歌名</th>
                    <th>歌手</th>
                    <th>专辑</th>
                    <th>歌词</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            {foreach $songs(key, value)}
                <tr>
                    <td>{@key+1}</td>
                    <td>{@value->title}</td>
                    <td>{@value->singer}</td>
                    <td>{@value->album}</td>
                    <td>{@value->lrc}</td>
                    <td><span>修改</span> | <span class="delete" data-name="music" title="{@value->id}">删除</span></td>
                </tr>
            {/foreach}
            </tbody>
        </table>
        <div id="page">{$page}</div>
    {/if}
    {if $image}
        <table class="list">
            <thead>
            <tr>
                <th>编号</th>
                <th>图名</th>
                <th>作者</th>
            </tr>
            </thead>
            <tbody>
            {foreach $images(key, value)}
                <tr>
                    <td>{@value->id}</td>
                    <td>{@value->title}</td>
                    <td>{@value->author}</td>
                </tr>
            {/foreach}
            </tbody>
        </table>
        <div id="page">{$page}</div>
    {/if}
    {if $article}
        <table class="list">
            <thead>
            <tr>
                <th>编号</th>
                <th>标题</th>
                <th>作者</th>
                <th>分类</th>
                <th>发表时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            {foreach $articles(key, value)}
                <tr>
                    <td>{@value->id}</td>
                    <td>{@value->title}</td>
                    <td>{@value->author}</td>
                    <td>{@value->type}</td>
                    <td>{@value->posttime}</td>
                    <td><span class="modify" data-name="article" title="{@value->id}">修改</span> | <span class="delete" data-name="article" title="{@value->id}">删除</span></td>
                </tr>
            {/foreach}
            </tbody>
        </table>
        <div id="page">{$page}</div>
    {/if}
</div>
<script src="../src/js/Toad.js" charset="utf-8"></script>
<script>
    TS(".toggle").click(function() {
        if (! TS(this).hasClass("open")) {
            TS(this).addClass("open");
            TS(this).parent().find("dd").addClass("hover");
        } else {
            TS(this).removeClass("open");
            TS(this).parent().find("dd").removeClass("hover");
        }
    });
    TS(".delete").on("click", function() {
        confirm("您真的要删除？") ?
                location.href = "list.php?action=" + TS(this).data("name") + "&active=delete&id=" + TS(this).attr("title") : null;
    });
    TS(".modify").on("click", function(){
        location.href = "post.php?action=" + TS(this).data("name") + "&id=" + TS(this).attr("title");
    });
</script>
</body>
</html>
