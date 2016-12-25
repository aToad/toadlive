<?php
/**
 * Created by PhpStorm
 * User: Toad
 * Date: 2016/11/30
 * Time: 14:35.
 */
require substr(__DIR__, 0, -5) . "\\config\\config.php";
session_destroy();
Tool::alertLocation(null, "login.php");