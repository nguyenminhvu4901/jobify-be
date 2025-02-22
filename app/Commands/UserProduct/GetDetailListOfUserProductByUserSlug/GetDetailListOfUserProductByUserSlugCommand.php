<?php

namespace App\Commands\UserProduct\GetDetailListOfUserProductByUserSlug;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

class GetDetailListOfUserProductByUserSlugCommand implements CommandInterface
{
    public function __construct()
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self();
    }
}
