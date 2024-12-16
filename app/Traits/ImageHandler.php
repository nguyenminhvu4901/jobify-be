<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;

trait ImageHandler
{
    public function storeImage(UploadedFile $file)
    {
        dd($file);
    }

    public function updateImage($oldImage, $newImage)
    {

    }

    public function deleteImage()
    {

    }
}
