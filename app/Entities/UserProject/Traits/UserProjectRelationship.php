<?php

namespace App\Entities\UserProject\Traits;

use App\Entities\UserProjectResource\Traits\UserProjectResourceRelationship;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait UserProjectRelationship
{
    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function userProjectResource(): HasMany
    {
        return $this->hasMany(UserProjectResourceRelationship::class);
    }
}
