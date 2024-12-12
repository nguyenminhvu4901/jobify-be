<?php

namespace App\Entities\UserExperienceResource\Traits;

use App\Entities\DefaultContentType\DefaultContentType;
use App\Entities\UserExperience\UserExperience;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait UserExperienceResourceRelationship
{
    /**
     * @return BelongsTo
     */
    public function userExperience(): BelongsTo
    {
        return $this->belongsTo(UserExperience::class, 'user_experience_id');
    }

    /**
     * @return BelongsTo
     */
    public function contentType(): BelongsTo
    {
        return $this->belongsTo(DefaultContentType::class, 'content_type_id', 'id');
    }
}
