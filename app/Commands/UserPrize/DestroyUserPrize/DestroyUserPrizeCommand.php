<?php

namespace App\Commands\UserPrize\DestroyUserPrize;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

class DestroyUserPrizeCommand implements CommandInterface
{
    public function __construct()
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self();
    }
}
