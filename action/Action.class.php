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

    function __construct($view, $model)
    {
        $this->view = $view;
        $this->model = $model;
    }
}
