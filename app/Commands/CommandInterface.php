<?php

namespace App\Commands;

use Illuminate\Foundation\Http\FormRequest;

interface CommandInterface
{
    public static function withForm(FormRequest $request): self;
}
