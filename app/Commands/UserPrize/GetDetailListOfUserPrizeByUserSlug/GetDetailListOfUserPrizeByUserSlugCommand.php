<?php

namespace App\Commands\UserPrize\GetDetailListOfUserPrizeByUserSlug;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

class GetDetailListOfUserPrizeByUserSlugCommand implements CommandInterface
{
    public function __construct()
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self();
    }
}
