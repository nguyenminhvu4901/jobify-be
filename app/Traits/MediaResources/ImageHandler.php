<?php

namespace App\Traits\MediaResources;

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

            $fileName = $prefixEmail . '_' . now()->format('Ymd_His') . '_' . Str::random(8) . '.' . $file->extension();

            storageMinIO()->putFileAs($path, $file, $fileName);

            return storageMinIO()->url($path . '/' . $fileName);
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
        $urlAvatarDefault = asset(config('constants.default_avatar'));

        if($absolutePath == $urlAvatarDefault) {
            return true;
        }

        $path = parse_url($absolutePath, PHP_URL_PATH);

        $path = Str::replaceFirst('/' . bucketMinIO() . '/', '', $path);

        if (storageMinIO()->exists($path)) {

            return storageMinIO()->delete($path);
        } else {

            return false;
        }
    }
}
