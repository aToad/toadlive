<?php

/**
 *
 */
class Validate
{

    public function __construct($argument)
    {

    }

    /**
     * 删除左右两边的空白
     * @param  array|object $argument 对象|数组
     * @return array|object 对象或数组
     */
    public static function trimEnhance($argument)
    {
        if (is_array($argument)) {
            foreach ($argument as $key => $value) {
                $argument[$key] = trim($value);
            }
        } elseif (is_object($argument)) {
            foreach ($argument as $key => $value) {
                $argument->$key = trim($value);
            }
        }
        return $argument;
    }

    /**
     * 限制字符串的长度
     * @param  string $string 用户输入的字符串
     * @param  int $min    字符串的最小长度
     * @param  int $max    字符串的最大长度
     * @return string      符合要求的字符串
     */
    public static function limitLength($string, $min, $max)
    {
        if (strlen($string) < $min || strlen($string) > $max || mb_strlen($string, "utf8") < $min || mb_strlen($string, "utf8") > $max) {
            Tool::alertBack("字符长度不符合要求！");
        }
        return $string;
    }

    /**
     * 两个参数是否相等
     * @param  string  $str1 字符1
     * @param  string  $str2 字符2
     * @return bool    布尔值
     */
    public static function isEqual($str1, $str2)
    {
        if ($str1 !== $str2) {
            Tool::alertBack("字符不一致！");
        }
    }

}
