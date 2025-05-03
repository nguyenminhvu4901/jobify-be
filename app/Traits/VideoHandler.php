<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait VideoHandler
{
    public function storeVideo($file, $path, $user): ?string
    {
        if (! empty($file)) {
            $prefixEmail = extractEmailPrefix($user->email);

            $fileName = $prefixEmail.'-'.Str::random(50).'.'.$file->extension();

            $file->storeAs('public/'.$path.'/'.$fileName);

            return asset('storage/'.$path.'/'.$fileName);
        }

        return null;
    }

    public function updateVideo($file, $path, $oldPath, $user): ?string
    {
        if (! empty($file)) {
            $this->deleteVideo($oldPath);

            return $this->storeVideo($file, $path, $user);
        }

        return null;
    }

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
