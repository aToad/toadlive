<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, minimum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home | Toad's Blog</title>
    <link rel="stylesheet" href="static/css/home.min.css">
    <link rel="stylesheet" href="static/css/awesome.min.css">
    <!--[if lte IE 9]>
        <link rel="stylesheet" href="static/css/ie9.min.css">
    <![endif]-->
</head>
<body class="ts">
    <div class="bg">
        <div class="img img-fade"></div>
        <div class="img img-active"></div>
        <div class="img img-src" data-author="Toad's Blog" data-title="Home"></div>
    </div>
    <div class="entry">
        <a href="blog/index.php" target="_blank">ENTER</a>
    </div>
    <div class="fix">
        <div class="music">
            <header class="title">
                <span class="icon icon-music"></span>
                Music
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
        <div class="image" id="image">
            <header class="title">
                egamI
                <span class="icon icon-picture"></span>
            </header>
            <div class="controls">
                <span class="icon icon-backward" id="next-image" title="下一张"></span>
                <span class="icon icon-fullscreen" id="fullscreen" title="全屏"></span>
                <span class="icon icon-resize-small" id="exit-fullscreen" title="退出全屏"></span>
            </div>
        </div>
    </div>

    <script src="src/js/Toad.js" charset="utf-8"></script>
    <script src="src/js/home.js" charset="utf-8"></script>
</body>
</html>