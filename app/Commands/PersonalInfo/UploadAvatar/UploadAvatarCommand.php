<?php

namespace App\Commands\PersonalInfo\UploadAvatar;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

readonly class UploadAvatarCommand implements CommandInterface
{
    /**
     * @param UploadedFile|string|null $avatar
     */
    public function __construct(
        public UploadedFile|null|string $avatar
    )
    {}

    /**
     * @param FormRequest $request
     * @return CommandInterface
     */
    public static function withForm(FormRequest $request): CommandInterface
    {
        $avatarRequest = self::getAvatarRequest($request);

        return new self(
            avatar: $avatarRequest
        );
    }

    /**
     * @param $request
     * @return string|null
     */
    private static function getAvatarRequest($request): ?string
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
