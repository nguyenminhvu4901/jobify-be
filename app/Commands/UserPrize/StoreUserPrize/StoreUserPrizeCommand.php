<?php

namespace App\Commands\UserPrize\StoreUserPrize;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserPrizeCommand implements CommandInterface
{
    public function __construct()
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self();
    }
}
