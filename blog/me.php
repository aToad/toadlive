<?php

require substr(__DIR__, 0, -5) . "/config/config.php";

$view = new View();

$view->render("me.tpl");
