<?php

namespace App\Traits;

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
        if($file)
        {
            $prefixEmail = extractEmailPrefix($user->email);

            $fileName = $prefixEmail . '-' . Str::random(50).'.'.$file->extension();

            $file->storeAs('public/'.$path.'/'.$fileName);

            return asset('storage/'.$path.'/'.$fileName);
        }

        return null;
    }
}
