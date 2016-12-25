<?php

/**
 * Created by PhpStorm
 * User: Toad
 * Date: 2016/11/29
 * Time: 20:40.
 */
class ListAction extends Action
{

    public function __construct()
    {
        parent::__construct(new View(), new ListModel());
        $this->action();
    }

    public function action()
    {
        switch ($_GET["action"]) {
            case 'music':
                $this->view->inject("music", true); // 路由控制
                $this->view->inject("list", "歌曲列表"); // 活动导航
                $this->view->inject("admin", $_SESSION["username"]); // 管理员

                # 分页
                $page = new Page($this->model->getAllSongs(), PAGE_SIZE);
                $this->view->inject("songs", $this->model->getPageSongs($page->limit));
                $this->view->inject("page", $page->outputHTML());

                if (isset($_GET["active"])) { // 删除歌曲
                    $this->model->id = $_GET["id"];
                    if ($this->model->removeOneSong()) {
                        Tool::alertLocation("删除成功！", "list.php?action=music");
                    }
                }
                break;

            case 'image':
                $this->view->inject("image", true); // 路由控制
                $this->view->inject("list", "图片列表"); // 活动导航
                $this->view->inject("admin", $_SESSION["username"]); // 管理员

                $page = new Page($this->model->getAllImages(), PAGE_SIZE);
                $this->view->inject("images", $this->model->getPageImages($page->limit));
                $this->view->inject("page", $page->outputHTML());
                break;

            case "article":
                $this->view->inject("article", true); // 路由控制
                $this->view->inject("list", "文章列表"); // 活动导航
                $this->view->inject("admin", $_SESSION["username"]); // 管理员

                # 分页
                $page = new Page($this->model->getAllArticles(), PAGE_SIZE);
                $this->view->inject("articles", $this->model->getPageArticles($page->limit));
                $this->view->inject("page", $page->outputHTML());
                break;

            default:
                # code...
                break;
        }
    }

}
