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
     * @return string|null
     */
    public function storeImage($file, $path, $user): string|null
    {
        if($file)
        {
            $prefixEmail = extractEmailPrefix($user->email);

            $fileName = $prefixEmail . '-' . Str::random(50).'.'.$file->extension();

            $file->storeAs('public/'.$path.'/'.$fileName);

            return asset('storage/'.$path.'/'.$fileName);
        }

        return null;
    }

    /**
     * @param $file
     * @param $path
     * @param $oldPath
     * @param $user
     * @return string|null
     */
    public function updateImage($file, $path, $oldPath, $user): ?string
    {
        $this->deleteImage($oldPath);

        return $this->storeImage($file, $path, $user);
    }

    /**
     * @param $absolutePath
     * @return bool
     */
    public function deleteImage($absolutePath): bool
    {
        $path = parse_url($absolutePath, PHP_URL_PATH);

        $path = ltrim($path, '/storage');

        if (Storage::disk('public')->exists($path)) {

            return Storage::disk('public')->delete($path);
        } else {

            return false;
        }
    }
}
