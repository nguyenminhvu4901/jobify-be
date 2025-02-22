<?php

namespace App\Commands\UserProduct\StoreUserProduct;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserProductCommand implements CommandInterface
{
    public function __construct()
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        // TODO: Implement withForm() method.
    }
}
