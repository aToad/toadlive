<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, minimum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>发表文章 | Toad's Blog</title>
    <link rel="stylesheet" href="../static/css/post.min.css">
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
            <li><a href="">{$post}</a></li>
        </ul>
    </nav>
    {if $article}
        <form action="" method="post">
            {if $modify}
            <fieldset class="aside">
                <legend>文章信息</legend>
                <p>
                    <label for="title">标题：</label>
                    <input type="text" name="title" id="title" value="{$one->title}">
                </p>
                <p>
                    <label for="author">作者：</label>
                    <input type="text" name="author" id="author" value="{$one->author}">
                </p>
                <p>
                    <label for="type">类型：</label>
                    <select id="checked" name="type" data-type="{$one->type}">
                        {foreach $types(key, value)}
                        <option class="option" value="{@value->id}">{@value->type}</option>
                        {/foreach}
                    </select>
                </p>
            </fieldset>
            <fieldset class="main">
                <legend>文章内容</legend>
                <div class="edit">
                    <label for="article">编辑：</label>
                    <textarea id="article" name="markdown">{$one->markdown}</textarea>
                </div>
                <div class="preview">
                    <label for="preview">预览：</label>
                    <textarea id="preview" name="preview">{$one->preview}</textarea>
                </div>
            </fieldset>
            <input type="submit" value="更新" name="send">
            {else}
            <fieldset class="aside">
                <legend>文章信息</legend>
                <p>
                    <label for="title">标题：</label>
                    <input type="text" name="title" id="title">
                </p>
                <p>
                    <label for="author">作者：</label>
                    <input type="text" name="author" id="author">
                </p>
                <p>
                    <label for="type">类型：</label>
                    <select name="type">
                        {foreach $types(key, value)}
                        <option value="{@value->id}">{@value->type}</option>
                        {/foreach}
                    </select>
                </p>
            </fieldset>
            <fieldset class="main">
                <legend>文章内容</legend>
                <div class="edit">
                    <label for="article">编辑：</label>
                    <textarea id="article" name="markdown">
                    </textarea>
                </div>
                <div class="preview">
                    <label for="preview">预览：</label>
                    <textarea id="preview" readonly name="preview"></textarea>
                </div>
            </fieldset>
            <input type="submit" value="发表" name="send">
            {/if}
        </form>
    {/if}
</div>
<script src="../src/js/Toad.js" charset="utf-8"></script>
<script src="../static/js/markdown.min.js"></script>
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
    if (TS("option").hasClass("option")) {
        var option = document.querySelector("#checked").children;
        for (var i = 0, len = option.length; i < len; i++) {
            if (option[i].value === TS("#checked").data("type")) {
                option[i].selected = true;
            }
        }
    }
    TS("#article").on("keyup", function() {
        TS("#preview").html(markdown.toHTML(this.value));
    });
</script>
</body>
</html>
