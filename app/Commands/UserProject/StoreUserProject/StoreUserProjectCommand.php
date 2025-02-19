<?php

namespace App\Commands\UserProject\StoreUserProject;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserProjectCommand implements CommandInterface
{
    public function __construct()
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self();
    }
}
