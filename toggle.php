<?php
/**
 * Created by PhpStorm
 * User: Toad
 * Date: 2016/11/27
 * Time: 10:49.
 */

require __DIR__ . "/config/config.php";

if (isset($_GET["requestImage"])) {

    $model = new Model();
    $queryAll = "SELECT src, author, title FROM ts.bg";
    $result = $model->getAll($queryAll);
    $total = count($result);
    $unique = $result[mt_rand(0, $total-1)];
    echo '{"src": "' . $unique->src . '", "author": "' . $unique->author . '", "title": "' . $unique->title . '"}';
} elseif (isset($_GET["requestSong"])) {

	$model = new Model();
    $queryAll = "SELECT src FROM ts.song";
    $result = $model->getAll($queryAll);
    $total = count($result);
    echo $result[mt_rand(0, $total-1)]->src;
}
