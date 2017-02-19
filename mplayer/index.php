<?php  

// $mysqli = new mysqli("localhost", "root", "root", "ts");
$mysqli = new mysqli("bdm249404492.my3w.com", "bdm249404492", "toMySwan930518", "bdm249404492_db");
if (mysqli_connect_errno()) {
    Tool::alertBack("连接数据库服务器失败：" . mysqli_connect_error());
}
$mysqli->query("SET NAMES UTF8");

// 获取歌曲列表
$result = $mysqli->query("SELECT * FROM song");
while (!! $row = $result->fetch_object()) {
    $rows[] = $row;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TSPlayer</title>
    <link rel="stylesheet" href="static/css/style.min.css">
    <link rel="stylesheet" href="static/css/awesome.min.css">
</head>
<body class="mplayer">
    <header class="header">
        <h1>网易云音乐</h1>
    </header>
    <div class="container">
        <nav class="nav">
            <div class="playing">
                <figure>
                    <img src="../upload/cover/cover.jpg" alt="" class="cover">
                    <figcaption class="detail">
                        <span class="title">歌曲</span>
                        <span class="author">歌手</span>
                    </figcaption>
                </figure>
                <div class="action">
                    <span class="icon icon-heart-empty"></span>
                    <span class="icon icon-share"></span>
                </div>
            </div>
        </nav>
        <div class="main">
            <table id="list">
                <thead>
                    <tr>
                        <th class="number">序号</th>
                        <th>歌手</th>
                        <th>专辑</th>
                        <th>标题</th>
                        <th>操作</th>
                    </tr>         
                </thead>
                <tbody>
                    <?php foreach ($rows as $key => $value) { ?>                  
                    <tr class="click-play" 
                        cover="<?php print_r($rows[$key]->cover) ?>" 
                        lrc="<?php print_r($rows[$key]->lrc) ?>"
                        src="<?php print_r($rows[$key]->src) ?>">
                        <td class="number">
                            <?php print_r($rows[$key]->id) ?>
                        </td>
                        <td><?php print_r($rows[$key]->author) ?></td>
                        <td><?php print_r($rows[$key]->album) ?></td>
                        <td><?php print_r($rows[$key]->title) ?></td>
                        <td>删除 | 分享</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div id="fullshow">
                <div class="fullcover">
                    <div class="circle-cover">
                        <img src="../upload/cover/cover.jpg" class="cover" alt="">
                    </div>
                    <div class="fullaction">
                        <ul>
                            <li>喜欢 <span class="icon icon-heart-empty"></span></li>
                            <li>收藏 <span class="icon icon-plus-sign-alt"></span></li>
                            <li>下载 <span class="icon icon-download-alt"></span></li>
                            <li>分享 <span class="icon icon-share"></span></li>
                        </ul>
                    </div>
                </div>
                <div class="fullsong">
                    <header>
                        <h3 class="title">title</h3>
                        <p>
                            <span>专辑：</span><span class="album"></span>
                            <span>歌手：</span><span class="author"></span>
                        </p>
                    </header>
                    <div class="lrc">
                        <ul id="lrc-list">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="controls">
            <div id="prev">
                <span class="icon icon-step-backward"></span>
            </div>
            <div id="play-toggle">
                <span class="icon icon-play"></span>
            </div>
            <div id="next">
                <span class="icon icon-step-forward"></span>
            </div>
        </div>
        <div class="progress">
            <span id="playing">00:00</span>
            <progress id="play-progress" value="0" max="0"></progress>
            <span id="duration">00:00</span>
        </div>
        <div class="volume">
            <div id="volume-toggle">
                <span class="icon icon-volume-up"></span>
            </div>         
            <progress id="volume-bar" max="120" value="120"></progress>
        </div>
        <div class="btns">
            <div id="repeat">
                <span class="icon icon-repeat"></span>
            </div>
            <div id="lrc">
                <span>词</span>
            </div>
            <div id="list">
                <span class="icon icon-list-alt"></span>
            </div>
        </div>
    </footer>
    <script src="static/js/bundle.js"></script>
</body>
</html>