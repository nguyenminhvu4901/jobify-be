<?php

namespace App\Commands\Auth\Role;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

class RoleCommand implements CommandInterface
{
    public function __construct()
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        // TODO: Implement withForm() method.
    }
}
