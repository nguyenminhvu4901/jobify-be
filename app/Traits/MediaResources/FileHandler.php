<?php

namespace App\Traits\MediaResources;

use Illuminate\Support\Str;

trait FileHandler
{
    /**
     * @param $file
     * @param $path
     * @return string|null
     */
    public function storeFile($file, $path): ?string
    {
        if(!empty($file))
        {
            $fileName = $file->getClientOriginalName();

            storageMinIO()->putFileAs($path, $file, $fileName);

            return storageMinIO()->url($path . '/' . $fileName);
        }

        return null;
    }

    /**
     * @param $file
     * @param $path
     * @param $oldPath
     * @return string|null
     */
    public function updateFile($file, $path, $oldPath): ?string
    {
        if(!empty($file))
        {
            $this->deleteFile($oldPath);

            return $this->storeFile($file, $path);
        }

        return null;
    }

    /**
     * @param $absolutePath
     * @return bool
     */
    public function deleteFile($absolutePath): bool
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
