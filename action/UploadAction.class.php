<?php

/**
 * Created by PhpStorm
 * User: Toad
 * Date: 2016/11/28
 * Time: 19:05.
 */
class UploadAction extends Action
{
    public function __construct()
    {
        parent::__construct(new View(), new UploadModel());
        $this->action();
    }

    /**
     * 路由控制
     * @return void
     */
    public function action()
    {
        switch ($_GET["action"]) {
        	case 'music':
                $this->view->inject("music", true);
                $this->view->inject("upload", "上传歌曲");
                $this->view->inject("admin", $_SESSION["username"]); // 管理员

                if (isset($_POST["send"])) {
                    $upload = new Upload($_FILES["select"], $_POST["MAX_FILE_SIZE"]);
                    if ($upload->movedToUpload()) {
                        $this->model->title = $_POST["title"];
                        $this->model->singer = $_POST["singer"];
                        $this->model->album = $_POST["album"];
                        $this->model->src = "upload/music/" . $_FILES["select"]["name"];
                        if ($this->model->uploadOneSong()) {
                            Tool::alertLocation("上传成功！", "list.php?action=music");
                        }
                    }
                }
        		break;

            case 'image':
                $this->view->inject("image", true);
                $this->view->inject("upload", "上传图片");
                $this->view->inject("admin", $_SESSION["username"]); // 管理员

                if (isset($_POST["send"])) {
                    $upload = new Upload($_FILES["select"], $_POST["MAX_FILE_SIZE"]);
                    if ($upload->movedToUpload()) {
                        $this->model->title = $_POST["title"];
                        $this->model->src = "upload/img/" . $upload->name;
                        $this->model->ext = $upload->ext;
                        $this->model->author = $_POST["author"];
                        $this->model->link = $_POST["link"];
                        if ($this->model->uploadOneImage()) {
                            Tool::alertLocation("上传成功！", "list.php?action=image");
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
