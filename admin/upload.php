<?php

require substr(__DIR__, 0, -5) . "/config/config.php";
if (isset($_SESSION["username"])) {
    $uploadAction = new UploadAction();
    $uploadAction->view->render("upload.tpl");
} else {
    Tool::alertLocation(null, "login.php");
}
