<?php

namespace App\Commands\UserProduct\UpdateUserProduct;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProductCommand implements CommandInterface
{
    public function __construct()
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self();
    }
}
