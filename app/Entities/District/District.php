<?php

namespace App\Entities\District;

use App\Entities\Province\Province;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class District extends Model implements Transformable
{
    use TransformableTrait, HasFactory;

    protected $table = 'districts';

    protected $fillable = [
        'province_id',
        'code',
        'district_name'
    ];

    /**
     * @return BelongsTo
     */
    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class)->withDefault();
    }
}
