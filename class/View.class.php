<?php

/**
*
*/
class View {

    /**
     * 存放变量的数组
     * @var array
     */
    public $vars = array();

    /**
     * 向模板中注入变量
     * @param  string $key   属性
     * @param  string $value 值
     * @return void
     */
	public function inject($key, $value) {
        $this->vars[$key] = $value;
	}

    /**
     * 渲染模板，输出编译文件或缓存文件
     * @param  string $basename 模板文件
     * @return string           缓存文件或者编译文件
     */
	public function render($basename) {

        # 模板文件路径
        $view = file_exists(FRONT_DIR . '/' . $basename) ? FRONT_DIR . '/' . $basename : BACK_DIR . '/' . $basename;

        # 处理带有查询字符串的url
        if (! empty($_SERVER['QUERY_STRING'])) {
            $basename .= $_SERVER["QUERY_STRING"];
        }

        $cpl = MIX_DIR. '/' .sha1($basename).$basename.'.php'; # 解析文件路径
        $cache = CACHE_DIR. '/' .sha1($basename).$basename.'.html'; # 缓存文件路径
        if (file_exists($view)) {
            $parser = new Parser($view); # 引入解析类
            $parser->parse($cpl); # 生成解析文件
            require $cpl;
        } else {
            exit("视图文件不存在！");
        }
	}
}
