<?php

namespace App\Commands\UserProject\UpdateUserProject;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProjectCommand implements CommandInterface
{
    public function __construct()
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self();
    }
}
