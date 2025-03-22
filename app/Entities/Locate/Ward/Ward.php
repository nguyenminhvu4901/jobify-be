<?php

namespace App\Entities\Locate\Ward;

use App\Entities\Locate\District\District;
use App\Entities\Locate\Province\Province;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Ward extends Model implements Transformable
{
    use TransformableTrait, HasFactory;

    protected $table = 'wards';

    protected $fillable = [
        'district_id',
        'code',
        'ward_name'
    ];

    /**
     * @return BelongsTo
     */
    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class, 'province_id', 'id')->withDefault();
    }

    /**
     * @return BelongsTo
     */
    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class, 'district_id', 'id')->withDefault();
    }
}
