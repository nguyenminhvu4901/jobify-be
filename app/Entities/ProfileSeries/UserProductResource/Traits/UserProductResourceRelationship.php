<?php

namespace App\Entities\ProfileSeries\UserProductResource\Traits;

use App\Entities\DefaultSeries\DefaultContentType\DefaultContentType;
use App\Entities\ProfileSeries\UserProduct\UserProduct;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait UserProductResourceRelationship
{
    public function contentType(): BelongsTo
    {
        return $this->belongsTo(DefaultContentType::class, 'content_type_id', 'id');
    }

    public function userProducts(): BelongsTo
    {
        return $this->belongsTo(UserProduct::class, 'user_product_id', 'id');
    }
}
