<?php

/**
 * authcode
 */
class Authcode
{
    /**
     * 二维码图片
     * @var image/png
     */
    private $img;

    /**
     * 二维码图片的宽度
     * @var int
     */
    private $width = 80;

    /**
     * 二维码图片的高度
     * @var int
     */
    private $height = 35;

    /**
     * 二维码可选字符集
     * @var string
     */
    private $string = "abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ23456789";

    /**
     * 二维码字符
     * @var string
     */
    private $code;

    /**
     * 字符个数
     * @var int
     */
    private $length = 4;

    /**
     * 字体大小
     * @var int
     */
    private $fontsize = 15;

    /**
     * 创建二维码字符
     * @return string 二维码字符
     */
    private function createCode()
    {
        $this->code = "";
        for ($i=0; $i < 4; $i++) {
            $this->code .= $this->string[mt_rand(0, strlen($this->string)-1)];
        }
        for ($i = 0; $i < $this->length; $i++) {
            imagettftext(
                $this->img,
                $this->fontsize,
                mt_rand(-30, 30),
                mt_rand($i * ($this->width/4), ($i+1) * ($this->width/4) - 10),
                mt_rand($this->height/2, $this->height/1.5),
                imagecolorallocate($this->img, mt_rand(0, 120), mt_rand(0, 120), mt_rand(0, 120)),
                "static/font/elephant.ttf",
                $this->code[$i]
            );
        }
    }

    /**
     * 创建二维码图片
     * @return void
     */
    private function createImage()
    {
        $this->img = imagecreatetruecolor($this->width, $this->height);
        $bg = imagecolorallocate($this->img, mt_rand(200, 255), mt_rand(200, 255), mt_rand(200, 255));
        imagefill($this->img, 0, 0, $bg);
    }

    /**
     * 创建二维码星星和线条
     * @return [type] [description]
     */
    private function createDecoration()
    {
        for ($i=0; $i < 200; $i++) {
            imagestring(
                $this->img,
                "2",
                mt_rand(0, 150),
                mt_rand(0, 80),
                "*",
                imagecolorallocate($this->img, mt_rand(100, 150), mt_rand(100, 200), mt_rand(100, 255))
            );
        }
        for ($i=0; $i < 6; $i++) {
            imageline(
                $this->img,
                mt_rand(0, 150),
                mt_rand(0, 80),
                mt_rand(0, 150),
                mt_rand(0, 80),
                imagecolorallocate($this->img, mt_rand(0, 50), mt_rand(50, 100), mt_rand(100, 150))
            );
        }
    }

    /**
     * 输出二维码字符
     * @return string 二维码字符
     */
    public function getCode()
    {
        return strtolower($this->code);
    }

    /**
     * 输出二维码
     * @return void
     */
    public function outputAuthcode()
    {
        $this->createImage();
        $this->createDecoration();
        $this->createCode();
        header("Content-Type: image/png");
        imagepng($this->img);
        imagedestroy($this->img);
    }
}
