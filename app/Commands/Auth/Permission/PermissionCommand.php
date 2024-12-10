<?php

namespace App\Commands\Auth\Permission;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

class PermissionCommand implements CommandInterface
{
    public function __construct()
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        // TODO: Implement withForm() method.
    }

}
