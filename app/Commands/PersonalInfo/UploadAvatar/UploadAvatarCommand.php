<?php

namespace App\Commands\PersonalInfo\UploadAvatar;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

class UploadAvatarCommand implements CommandInterface
{
    public function __construct(
        public readonly UploadedFile|null|string $avatar
    )
    {}

    public static function withForm(FormRequest $request): CommandInterface
    {
        $avatarRequest = self::getAvatarRequest($request);

        return new self(
            avatar: $avatarRequest
        );
    }

    private static function getAvatarRequest($request)
    {
        $avatarRequest = null;

        if (!empty($request->file('avatar'))){
            $avatarRequest = $request->file('avatar');

        }
        elseif(!empty($request->input('avatar')))
        {
            $avatarRequest = trim($request->input('avatar'));
        }

        return $avatarRequest;
    }
}
