<?php

require substr(__DIR__, 0, -5) . "/config/config.php";

if (isset($_GET["action"])) {

    Validate::trimEnhance($_POST);

    Validate::isEqual(strtolower($_POST["authcode"]), $_SESSION["authcode"]);

    $model = new Model();
    $query = "SELECT
                 id
              FROM
                  admin
              WHERE
                  username = '{$_POST['username']}'
              AND
                  password = SHA1('{$_POST['password']}')
              ";
    if ($model->isOne($query)) {
        $_SESSION["username"] = $_POST["username"];
        Tool::alertLocation(null, "list.php?action=music");
    } else {
        Tool::alertBack("登录失败！");
    }
}
$view = new View();
$view->render("login.tpl");
