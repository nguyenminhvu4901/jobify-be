<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BaseModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BaseModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BaseModel query()
 *
 * @mixin \Eloquent
 */
class BaseModel extends Model
{
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        if (defined(static::class.'::FILLABLE_FIELDS')) {
            $this->fillable = static::FILLABLE_FIELDS;
        }
    }
}
