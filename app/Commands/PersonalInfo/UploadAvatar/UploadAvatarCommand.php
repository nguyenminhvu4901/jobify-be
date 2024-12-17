<?php

namespace App\Commands\PersonalInfo\UploadAvatar;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

class UploadAvatarCommand implements CommandInterface
{
    public function __construct(
        public readonly UploadedFile|null $avatar
    )
    {}

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self(
            avatar: $request->file('avatar')
        );
    }
}
