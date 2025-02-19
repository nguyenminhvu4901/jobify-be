<?php

namespace App\Commands\UserProject\DestroyUserProject;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

class DestroyUserProjectCommand implements CommandInterface
{
    public function __construct()
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self();
    }
}
