<?php

/**
 * Created by Atom
 * User: Toad
 */
class Action
{
    /**
     * 视图
     * @var object
     */
    public $view;

    /**
     * 模型
     * @var object
     */
    protected $model;

    /**
     * 添加视图和模型属性
     * @param object $view  视图
     * @param object $model 模型
     */
    function __construct($view, $model)
    {
        $this->view = $view;
        $this->model = $model;
    }
}
