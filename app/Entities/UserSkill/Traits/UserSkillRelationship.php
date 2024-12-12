<?php

namespace App\Entities\UserSkill\Traits;

use App\Entities\DefaultRate\DefaultRate;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait UserSkillRelationship
{
    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function rate(): BelongsTo
    {
        return $this->belongsTo(DefaultRate::class, 'rate_id', 'id');
    }
}
