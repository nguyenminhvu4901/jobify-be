<?php

namespace App\Entities\User\Traits;

use App\Entities\DefaultStatus\DefaultStatus;

trait UserRelationship
{
    /**
     * @return mixed
     */
    public function status(): mixed
    {
        return $this->belongsTo(DefaultStatus::class);
    }
}
