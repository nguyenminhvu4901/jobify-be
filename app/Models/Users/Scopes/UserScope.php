<?php


namespace App\Models\Users\Scopes;

use App\Enums\Status;

trait UserScope
{
    public function scopeIsActive(): bool
    {
        return $this->status == Status::ACTIVE->value;
    }

    public function scopeIsDeActivate(): bool
    {
        return $this->status == Status::DEACTIVATE->value;
    }
}
