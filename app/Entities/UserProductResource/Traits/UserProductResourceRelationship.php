<?php

namespace App\Entities\UserProductResource\Traits;

use App\Entities\DefaultContentType\DefaultContentType;
use App\Entities\UserProduct\UserProduct;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait UserProductResourceRelationship
{
    /**
     * @return BelongsTo
     */
    public function contentType(): BelongsTo
    {
        return $this->belongsTo(DefaultContentType::class, 'content_type_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function userProduct(): BelongsTo
    {
        return $this->belongsTo(UserProduct::class, 'user_product_id', 'id');
    }
}
