<?php

/**
 * Created by PhpStorm.
 * User: Mandeep Singh
 * Date: 11/07/2016
 * Time: 20:12
 */

class image
{
    /**
     * method will display a cached image, if not will resize and cache it
     *
     * @param $picPath
     * @param $width
     * @param $height
     * @return image
     */
    public function showImage($picPath, $width, $height)
    {
        $cache = new cache();
        $cache->setKey ($picPath . $width . $height);
        $result = $cache->getByKey();

        if ($result) {
            header('Content-Type: image/jpeg');
            echo base64_decode($result);
        } else {
            header('Content-Type: image/jpeg');
            $result = resizeImage($picPath, $width, $height);
            imagejpeg($result);
            ob_start();
            imagejpeg($result);
            $result_64 = ob_get_contents();
            ob_end_clean();
            $cache->setKey($result_64);
            imagejpeg($result);
        }
    }

    /**
     * Method will resize the given image
     *
     * @param $image
     * @param $width
     * @param $height
     * @return image
     */
    public function resizeImage($image, $width, $height)
    {
        $image = imagecreatefromjpeg($image);
        $w = imagesx($image);
        $h = imagesy($image);

        $thumbImage = imagecreatetruecolor($width, $height);
        imagecopyresized($thumbImage, $image, 0, 0, 0, 0, $width, $height, $w, $h);
        imagedestroy($image);

        return $thumbImage;
    }
}
