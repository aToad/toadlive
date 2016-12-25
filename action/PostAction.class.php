<?php

/**
 *
 */
class PostAction extends Action
{

    function __construct()
    {
        parent::__construct(new View(), new PostModel());
        $this->action();
    }

    public function action()
    {
        switch ($_GET["action"]) {
            case 'article':
                $this->view->inject("article", true); // 路由控制
                $this->view->inject("admin", $_SESSION["username"]); // 管理员
                $list = new ListModel();
                $this->view->inject("types", $list->getAllTypes()); // 博文分类

                if (isset($_GET["id"])) { // 修改文章
                    $this->model->id = $_GET["id"];
                    $this->view->inject("modify", true);
                    $this->view->inject("one", $this->model->getOneArticle());
                    $this->view->inject("post", "更新文章");

                } else {
                    $this->view->inject("post", "发表文章"); // 活动导航
                }

                if (isset($_POST["send"])) {
                    Validate::trimEnhance($_POST);
                    $this->model->title = $_POST["title"];
                    $this->model->author = $_POST["author"];
                    $this->model->type = $_POST["type"];
                    $this->model->markdown = $_POST["markdown"];
                    $this->model->preview = htmlspecialchars($_POST["preview"]);

                    if (isset($_GET["id"])) {
                        if ($this->model->UpdateOneArticle()) {
                            Tool::alertLocation("更新成功！", "list.php?action=article");
                        }
                    } else {
                        if ($this->model->postOneArticle() && $this->model->isType()) {
                            if ($this->model->updateOneType()) {
                                Tool::alertLocation("发表成功！", "list.php?action=article");
                            }
                        }
                    }
                }
                break;

            default:
                # code...
                break;
        }
    }


}
