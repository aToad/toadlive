<?php

class Parser {

	# 视图内容
	private $view;

    # 获得视图内容
	public function __construct($view) {
        $this->view = file_get_contents($view);
	}

	# 简写替换函数
	private function replace($ptn, $replacement) {
		return preg_replace($ptn, $replacement, $this->view);
	}

	# 解析变量
	private function parse_var() {
		$ptn = '/\{\$(\w+)\}/';
		if (preg_match($ptn, $this->view)) {
			$this->view = $this->replace($ptn, "<?php echo \$this->vars['$1'] ?>");
		}
	}

	# 解析单个对象
	private function parse_object()
	{
		$ptn = '/\{\$(\w+)\->(\w+)\}/';
		if (preg_match($ptn, $this->view)) {
			$this->view = $this->replace($ptn, "<?php echo \$this->vars['$1']->$2 ?>");
		}
	}

	# 解析 if 语句
	private function parse_if() {
		$ptn_if = '/\{if\s+\$(\w+)\}/';
		$ptn_else = '/\{else\}/';
		$ptn_endif = '/\{\/if\}/';
		if (preg_match($ptn_if, $this->view)) {
			if (preg_match($ptn_endif, $this->view)) {
				$this->view = $this->replace($ptn_if, "<?php if (isset(\$this->vars['$1'])) { ?>");
				$this->view = $this->replace($ptn_endif, "<?php } ?>");
				if (preg_match($ptn_else, $this->view)) {
					$this->view = $this->replace($ptn_else, "<?php } else { ?>");
				}
			}
		}
	}

	# 解析 include 语句
	private function parse_include() {
		$ptn = '/\{include\s+file=("|\')([\w\-\.\/]+)("|\')\}/';
		if (preg_match($ptn, $this->view)) {
			$this->view = $this->replace($ptn, "<?php include '$2' ?>");
		}
	}

    # 解析 require 语句
    private function parse_require() {
		$ptn = '/\{require\s+file=("|\')([\w\-\.\/]+)("|\')\}/';
		if (preg_match_all($ptn, $this->view, $views)) {
			foreach ($views[2] as $key => $value) {
				$this->view = $this->replace($ptn, "<?php require \$tpl->render_part('$2'); ?>");
			}
		}
	}

	# 解析 foreach 语句
	private function parse_foreach() {
		$ptn_foreach = '/\{foreach\s+\$(\w+)\((\w+),\s+(\w+)\)\}/';
		$ptn_endforeach = '/\{\/foreach\}/';
		$ptn_val = '/\{@([\w\-\.>\+]+)\}/';
		if (preg_match($ptn_foreach, $this->view)) {
			if (preg_match($ptn_endforeach, $this->view)) {
				$this->view = $this->replace($ptn_foreach, "<?php foreach (\$this->vars['$1'] as \$$2 => \$$3) { ?>");
				$this->view = $this->replace($ptn_endforeach, "<?php } ?>");
				if (preg_match($ptn_val, $this->view)) {
					$this->view = $this->replace($ptn_val, "<?php echo \$$1 ?>");
				}
			}
		}
	}

    # 解析视图并生成编译文件
    public function parse($cpl) {
    	$this->parse_var();
		$this->parse_object();
    	$this->parse_if();
    	$this->parse_include();
		$this->parse_require();
    	$this->parse_foreach();
        file_put_contents($cpl, $this->view);
    }

}

?>
