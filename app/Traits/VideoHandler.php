<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
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

        $path = ltrim($path, '/storage');

        if (Storage::disk('public')->exists($path)) {

            return Storage::disk('public')->delete($path);
        } else {

            return false;
        }
    }
}
