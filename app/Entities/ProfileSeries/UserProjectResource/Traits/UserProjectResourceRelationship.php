<?php

namespace App\Entities\ProfileSeries\UserProjectResource\Traits;

use App\Entities\DefaultSeries\DefaultContentType\DefaultContentType;
use App\Entities\ProfileSeries\UserProject\UserProject;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait UserProjectResourceRelationship
{
    /**
     * @return BelongsTo
     */
    public function userProject(): BelongsTo
    {
        return $this->belongsTo(UserProject::class, 'user_project_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function contentType(): BelongsTo
    {
        return $this->belongsTo(DefaultContentType::class, 'content_type_id', 'id');
    }
}
