<?php

require __DIR__ . "/config/config.php";

$code = new Authcode();

$code->outputAuthcode();

$_SESSION["authcode"] = $code->getCode();

?>
