<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait ImageHandler
{
    /**
     * @param $file
     * @param $path
     * @param $user
     * @return string
     */
    public function storeImage($file, $path, $user): string
    {
        $prefixEmail = extractEmailPrefix($user->email);

        $fileName = $prefixEmail . Str::random().'.'.$file->extension();

        $file->storeAs('public/'.$path.'/'.$fileName);

        return asset('storage/'.$path.'/'.$fileName);
    }

    /**
     * @param $oldImage
     * @param $newImage
     * @return void
     */
    public function updateImage($oldImage, $newImage)
    {

    }

    /**
     * @param $path
     * @param $user
     * @return bool
     */
    public function deleteImage($path, $user): bool
    {
        $fileName = basename(parse_url($user->avatar, PHP_URL_PATH));
        return Storage::disk('public')->delete($path.'/'.$fileName);
    }
}
