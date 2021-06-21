<?php

namespace App\Libraries;

use Config\Services;

class ImagesLib
{
    public function uploadCompress(string $path, string $fileName, string $fileNameSmall, int $width = 500, int $height = 250, int $quality = 100)
    {
        Services::image()->withFile(ROOTPATH . $path . $fileName)->resize($width, $height, true, 'height')->save(ROOTPATH . $path . $fileNameSmall, $quality);
    }
}