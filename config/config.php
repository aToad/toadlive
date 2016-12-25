<?php

header("Content-Type: text/html; charset=utf8"); # 字符编码
define("ROOT", substr(__dir__, 0, -7));# 根目录
define("FRONT_DIR", ROOT . "/view/frontend"); # 前台视图目录
define("BACK_DIR", ROOT . "/view/backend"); # 后台视图目录
define("MIX_DIR", ROOT . "/mix"); # 编译目录
define("CACHE_DIR", ROOT . "/cache"); # 缓存目录
define("PAGE_SIZE", 5); # 每页分页显示的条数
session_start(); # 开启Session

# 自动加载类
function __autoload($classname) {
	if (strtolower(substr($classname, -6)) == "action") {
		require ROOT . "/action/" . $classname . ".class.php";
	} elseif (strtolower(substr($classname, -5)) == "model") {
        require ROOT . "/model/" . $classname . ".class.php";
	} else {
		require ROOT . "/class/" . $classname . ".class.php";
	}
}
