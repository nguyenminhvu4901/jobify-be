<?php

namespace App\Commands\UserProduct\DestroyUserProduct;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

class DestroyUserProductCommand implements CommandInterface
{
    public function __construct()
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self();
    }
}
