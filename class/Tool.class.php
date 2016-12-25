<?php

/**
* 工具类
*/
class Tool
{
    public static function alertBack($info)
    {
    	echo "<script>alert('" . $info . "');history.go(-1);</script>";
        exit();
    }

    public static function alertLocation($info, $url)
    {
        if (empty($info)) {
            header("Location: $url");
        } else {
            echo "<script>alert('" . $info . "'); window.location.href='" . $url . "'</script>";
            exit();
        }

    }

    public static function alert($info)
    {
    	echo "<script>alert('" . $info . "')</script>";
    }

    public static function decodeHtmlString($argument)
    {
        if (is_array($argument)) {
            foreach ($argument  as $key => $value) {
                $argument[$key] = Tool::decodeHtmlString($value);
            }
        } elseif (is_object($argument)) {
            foreach ($argument as $key => $value) {
                $argument->$key = Tool::decodeHtmlString($value);
            }
        } else {
            return htmlspecialchars_decode($argument);
        }
        return $argument;
    }
}
