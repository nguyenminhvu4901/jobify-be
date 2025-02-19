<?php

namespace App\Commands\UserProject\GetDetailListOfUserProjectByUserSlug;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

class GetDetailListOfUserProjectByUserSlugCommand implements CommandInterface
{
    public function __construct()
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self();
    }
}
