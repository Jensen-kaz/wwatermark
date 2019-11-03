<?php

namespace watermarkmaker\src;

class WatermarkMaker
{

    public function addWatermark($srcImage, $srcWatermark, $pathOut) {

        $imageInfo = getimagesize($srcImage);
        $watermarkInfo = getimagesize($srcWatermark);


        $watermarkWidth = $watermarkInfo[0];
        $watermarkHeight = $watermarkInfo[1];


        $format = strtolower(substr($imageInfo['mime'], strpos($imageInfo['mime'], '/') + 1));

        // определяем названия функция для создания и сохранения картинки
        $imageCreate = "imagecreatefrom" . $format;
        $imageSave = "image" . $format;

        $img = $imageCreate($srcImage);

        $watermark = imagecreatefrompng($srcWatermark);

        // определяем координаты левого верхнего угла водяного знака
        $dest_x = $imageInfo[0] - $watermarkWidth - 5;
        $dest_y = $imageInfo[1] - $watermarkHeight - 5;


        // помещаем водяной знак на изображение
        imagecopy($img, $watermark, $dest_x, $dest_y, 0, 0, $watermarkWidth, $watermarkHeight);

        // сохраняем изображение с уникальным именем
        $name = mt_rand(0, 10000) . basename($srcImage);
        $imageSave($img, $pathOut . '/' . $name);

    }
}