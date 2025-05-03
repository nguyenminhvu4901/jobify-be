<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait ImageHandler
{
    public function storeImage($file, $path, $user): ?string
    {
        if ($file) {
            $prefixEmail = extractEmailPrefix($user->email);

            $fileName = $prefixEmail.'-'.Str::random(50).'.'.$file->extension();

            $file->storeAs('public/'.$path.'/'.$fileName);

            return asset('storage/'.$path.'/'.$fileName);
        }

        return null;
    }

    public function updateImage($file, $path, $oldPath, $user): ?string
    {
        $this->deleteImage($oldPath);

        return $this->storeImage($file, $path, $user);
    }

    public function deleteImage($absolutePath): bool
    {
        $urlAvatarDefault = asset(config('constants.default_avatar'));

        if ($absolutePath == $urlAvatarDefault) {
            return true;
        }

        $path = parse_url($absolutePath, PHP_URL_PATH);

        $path = ltrim($path, '/storage');

        if (Storage::disk('public')->exists($path)) {

            return Storage::disk('public')->delete($path);
        } else {

            return false;
        }
    }
}
