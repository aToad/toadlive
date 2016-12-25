<?php
/**
 * Created by PhpStorm
 * User: Toad
 * Date: 2016/11/29
 * Time: 20:39.
 */

require substr(__DIR__, 0, -5) . "/config/config.php";
if (isset($_SESSION["username"])) {
    $listAction = new ListAction();
    $listAction->view->render("list.tpl");
} else {
    Tool::alertLocation(null, "login.php");
}
