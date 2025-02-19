<?php

namespace App\Commands\UserPrize\GetDetailListOfUserPrize;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

class GetDetailListOfUserPrizeCommand implements CommandInterface
{
    public function __construct()
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self();
    }
}
