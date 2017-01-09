<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, minimum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home | Toad's Blog</title>
    <link rel="stylesheet" href="static/css/home.min.css">
    <link rel="stylesheet" href="static/css/awesome.min.css">
</head>
<body class="ts">
    <div class="bg">
        <div class="img img-fade"></div>
        <div class="img img-active"></div>
        <div class="img img-src" data-author="Toad's Blog" data-title="Home"></div>
    </div>
    <div class="entry">
        <h1><a href="blog/index.php">Toad's Blog</a></h1>
        <div class="info">
            <div class="face"><img src="static/img/Toad.png" alt=""></div>
            <div class="intro">
                <p><span class="title">邮箱</span><span class="content">a_toad@163.com</span></p>
                <p><span class="title">博客</span><span class="content"><a href="http://www.toadlive.cn/blog">http://www.toadlive.cn/blog</a></span></p>
                <p><span class="title">码农</span><span class="content">HTML/CSS/JavaScript/Node/PHP</span></p>
            </div>
            <div class="lrc">
                <!-- 暂无歌词 -->
            </div>
        </div>
    </div>

    <div class="fix">
        <div class="music">
            <header class="title">
                <span class="icon icon-music"></span>
            </header>
            <div class="controls">
                <span class="icon icon-play" title="播放" id="music-toggle"></span>
                <span class="icon icon-forward" title="下一曲" id="music-next"></span>
            </div>
            <audio src="upload/music/茶太 - 星空のメモリア.mp3" id="music"></audio>
        </div>
        <div class="toc">
            <div class="link">
                <a href="https://github.com/aToad" target="_blank"><span class="icon icon-github"></span> Toad's Github</a>
                <a href="blog/index.php" target="_blank"><span class="icon icon-home"></span> Toad's Blog</a>
                <a href="https://atoad.github.io/" target="_blank"><span class="icon icon-bookmark"></span> Toad's Notes</a>
            </div>
        </div>
        <div class="image">
            <header class="title">
                <span class="icon icon-picture"></span>
            </header>
            <div class="controls">
                <span class="icon icon-backward" id="next-image" title="下一张"></span>
                <span class="icon icon-fullscreen" id="fullscreen" title="全屏"></span>
                <span class="icon icon-resize-small" id="exit-fullscreen" title="退出全屏"></span>
            </div>
        </div>
        <div class="circle">
            <span class="icon icon-double-angle-down"></span>
        </div>
        <div class="date">
            <header class="title">
                <span id="month"></span>
                <span id="day"></span>
            </header>
            <div class="controls">
                <span id="year"></span>
            </div>
        </div>
        <div class="time">
            <header class="title">
                <span id="second"></span>
                <span id="minute"></span>
            </header>
            <div class="controls">
                <span id="hour"></span>
            </div>
        </div>
    </div>

    <script src="src/js/Toad.js" charset="utf-8"></script>
    <script src="src/js/home.js" charset="utf-8"></script>
</body>
</html>
