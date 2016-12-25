<?php

require substr(__DIR__, 0, -5) . "/config/config.php";
if (isset($_SESSION["username"])) {
    $postAction = new PostAction();
    $postAction->view->render("post.tpl");
} else {
    Tool::alertLocation(null, "login.php");
}
