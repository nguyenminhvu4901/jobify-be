<?php

namespace App\Traits\MediaResources;

use Illuminate\Support\Str;

trait VideoHandler
{
    /**
     * @param $file
     * @param $path
     * @param $user
     * @return string|null
     */
    public function storeVideo($file, $path, $user): ?string
    {
        if(!empty($file))
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
    public function updateVideo($file, $path, $oldPath, $user): ?string
    {
        if(!empty($file))
        {
            $this->deleteVideo($oldPath);

            return $this->storeVideo($file, $path, $user);
        }

        return null;
    }

    /**
     * @param $absolutePath
     * @return bool
     */
    public function deleteVideo($absolutePath): bool
    {
        $path = parse_url($absolutePath, PHP_URL_PATH);

        $path = Str::replaceFirst('/' . bucketMinIO() . '/', '', $path);

        if (storageMinIO()->exists($path)) {

            return storageMinIO()->delete($path);
        } else {

            return false;
        }
    }
}
