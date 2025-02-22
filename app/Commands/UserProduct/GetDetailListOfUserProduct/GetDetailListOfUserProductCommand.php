<?php

namespace App\Commands\UserProduct\GetDetailListOfUserProduct;

use App\Commands\CommandInterface;
use Illuminate\Foundation\Http\FormRequest;

class GetDetailListOfUserProductCommand implements CommandInterface
{
    public function __construct()
    {
    }

    public static function withForm(FormRequest $request): CommandInterface
    {
        return new self();
    }
}
