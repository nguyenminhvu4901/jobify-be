<?php

namespace App\Commands;

use Illuminate\Foundation\Http\FormRequest;

interface CommandInterface
{
    /**
     * @param FormRequest $request
     * @return self
     */
    public static function withForm(FormRequest $request): self;
}
