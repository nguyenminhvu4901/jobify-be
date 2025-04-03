<?php

namespace App\Models\Traits;

use App\Enums\Status;
use App\Traits\Scope\BaseScopeTrait;

trait UserScope
{
    use BaseScopeTrait;

    /**
     * @return bool
     */
    public function scopeIsActive(): bool
    {
        return $this->status_id == Status::ACTIVE->value;
    }
}
