<?php

/**
 * Created by PhpStorm
 * User: Toad
 * Date: 2016/11/29
 * Time: 8:00.
 */
class Upload {

    private $type;
    private $size;
    private $tmp;
    private $error;
    private $limitSize;
    private $upload;
    public $ext;
    public $name;

    function __construct($files, $maxFileSize)
    {
        $this->type =  $files["type"];
        $this->size = $files["size"];
        $this->tmp = $files["tmp_name"];
        $this->name = $files["name"];
        $this->error = $files["error"];
        $this->limitSize = $maxFileSize;
        $this->ext = $this->getExt();
        $this->checkType();
        $this->checkError();
    }

    private function getExt()
    {
        $arr = explode(".", $this->name);
        $index = count($arr);
        return $arr[$index-1];
    }

    private function checkType()
    {
        if (preg_match('/audio/', $this->type)) {
            $this->upload = ROOT . "/upload/music/" . $this->name;
            $array = array("audio/mpeg", "audio/mp3", "audio/x-wav");
            if (! in_array($this->type, $array)) {
                Tool::alertBack("请上传合法的音频文件！");
            }
        } elseif (preg_match('/image\/(\w+)/', $this->type)) {
            $this->name = date("YmdHis") . "." . $this->ext;
            $this->upload = ROOT . "/upload/img/" . $this->name;
            $array = array("image/jpeg", "image/png");
            if (! in_array($this->type, $array)) {
                Tool::alertBack("请输入合法的图像文件！");
            }
        }
    }

    private function checkError() {
        switch ($this->error) {
        	case '1':
        		# code...
        		break;

            case '2':
                Tool::alertBack("上传文件大小超过表单限制的" . $this->limitSize/1024/1024 . "M");
                break;

        	default:
        		# code...
        		break;
        }
    }

    public function movedToUpload()
    {
        if (is_uploaded_file($this->tmp)) {
            if (move_uploaded_file($this->tmp, $this->upload)) {
                return true;
            } else {
                Tool::alertBack("上传失败！");
            }
        }
    }

}
