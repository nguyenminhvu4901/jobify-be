<?php

namespace App\Entities\ProfileSeries\UserProject\Traits;

use App\Entities\ProfileSeries\UserProjectResource\UserProjectResource;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait UserProjectRelationship
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function userProjectResources(): HasMany
    {
        return $this->hasMany(UserProjectResource::class);
    }
}
