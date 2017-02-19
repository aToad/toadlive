<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, minimum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home | Toad's Blog</title>
    <link rel="stylesheet" href="static/css/home.min.css">
    <link rel="stylesheet" href="static/css/font-awesome.min.css">
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
        </div>
        <!--<div class="music">
            <div class="control"></div>
            <div class="lrc"></div>
            <div class="progress"></div>
        </div>-->
    </div>
    <div class="fix">
        <div class="music">
            <header class="title">
                <span class="fa fa-music"></span>
            </header>
            <div class="controls">
                <span class="fa fa-play" title="播放" id="music-toggle"></span>
                <span class="fa fa-forward" title="下一曲" id="music-next"></span>
            </div>
            <audio src="upload/mp3/1.mp3" id="music"></audio>
        </div>
        <div class="toc">
            <div class="link">
                <a href="https://github.com/aToad" target="_blank"><span class="fa fa-github"></span> Toad's Github</a>
                <a href="blog/index.php" target="_blank"><span class="fa fa-home"></span> Toad's Blog</a>
                <a href="https://atoad.github.io/" target="_blank"><span class="fa fa-bookmark"></span> Toad's Notes</a>
            </div>
        </div>
        <div class="image">
            <header class="title">
                <span class="fa fa-picture-o"></span>
            </header>
            <div class="controls">
                <span class="fa fa-backward" id="next-image" title="下一张"></span>
                <span class="fa fa-expand" id="fullscreen" title="全屏"></span>
                <span class="fa fa-compress" id="exit-fullscreen" title="退出全屏"></span>
            </div>
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