<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, minimum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>欢迎您的到访！</title>
    <link rel="stylesheet" href="../static/css/upload.min.css">
    <!--[if lte IE 9]>
        <link rel="stylesheet" href="static/css/ie9.min.css">
    <![endif]-->
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
                <li><a href="">上传</a>/</li>
                <li><a href="">{$upload}</a></li>
            </ul>
        </nav>
        {if $music}
            <form action="" name="upload-music" method="post" class="upload" enctype="multipart/form-data">
                <p>
                    <label for="select">选歌：</label>
                    <input type="hidden" name="MAX_FILE_SIZE" value="15728640">
                    <input type="file" name="select" id="select">
                    <span class="replacement">点我</span>
                </p>
                <p>
                    <label for="title">歌名：</label>
                    <input type="text" name="title" id="title">
                </p>
                <p>
                    <label for="singer">歌手：</label>
                    <input type="text" name="singer" id="singer">
                </p>
                <p>
                    <label for="album">专辑：</label>
                    <input type="text" name="album" id="album">
                </p>
                <p>
                    <label for="cover">封面：</label>
                    <input type="text" name="cover" id="cover">
                </p>
                <p>
                    <input type="submit" value="上传" name="send">
                </p>
            </form>
        {/if}
        {if $image}
            <form action="" name="upload-image" method="post" class="upload" enctype="multipart/form-data">
                <p>
                    <label for="select">选图：</label>
                    <input type="hidden" name="MAX_FILE_SIZE" value="15728640">
                    <input type="file" name="select" id="select">
                    <span class="replacement">点我</span>
                </p>
                <p>
                    <label for="title">图名：</label>
                    <input type="text" name="title" id="title">
                </p>
                <p>
                    <label for="author">作者：</label>
                    <input type="text" name="author" id="author">
                </p>
                <p>
                    <label for="link">链接：</label>
                    <input type="text" name="link" id="link">
                </p>
                <p>
                    <input type="submit" value="上传" name="send">
                </p>
            </form>
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

        if (TS(".upload").attr("name") === "upload-music") {
            TS("#select").on("change", function(e) {
                var files = this.files,
                        i, len;
                for (i = 0, len = files.length; i < len; i++) {
                    var name = files[i].name,
                            pos = name.lastIndexOf("."),
                            index = name.indexOf("-");
                    if (name.slice(pos+1) !== "mp3") {
                        alert("文件不是合法的音频文件！");
                    } else {
                        TS(".replacement").html(name);
                        TS("#title").attr("value", Toad.trim(name.slice(index+1, pos)));
                        TS("#singer").attr("value", Toad.trim(name.slice(0, index)));
                    }
                }
            });
        } else if(TS(".upload").attr("name") === "upload-image") {
            TS("#select").on("change", function(e) {
                var files = this.files,
                    arr = ["jpg", "png", "jpeg"],
                    i, len;
                for (i = 0, len = files.length; i < len; i++) {
                    var name = files[i].name,
                        pos = name.lastIndexOf("."),
                        ext = name.slice(pos+1);
                    if (! Toad.inArray(ext, arr)) {
                        alert("文件不是合法的图像文件！");
                    } else {
                        TS(".replacement").html(name);
                        TS("#title").attr("value", Toad.trim(name.slice(0, pos)));
                    }
                }
            });
        }

    </script>
</body>
</html>
