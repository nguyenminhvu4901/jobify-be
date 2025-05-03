<?php

namespace App\Models\Traits;

use App\Enums\StatusEnum;
use App\Traits\Scope\BaseScopeTrait;

trait UserScope
{
    use BaseScopeTrait;

    public function scopeIsActive(): bool
    {
        return $this->status_id == StatusEnum::ACTIVE->value;
    }
}
