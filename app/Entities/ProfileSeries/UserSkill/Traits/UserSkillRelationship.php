<?php

namespace App\Entities\ProfileSeries\UserSkill\Traits;

use App\Entities\DefaultSeries\DefaultRate\DefaultRate;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait UserSkillRelationship
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function rate(): BelongsTo
    {
        return $this->belongsTo(DefaultRate::class, 'rate_id', 'id');
    }
}
