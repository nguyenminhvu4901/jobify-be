<?php

namespace App\Entities\Locate\Ward;

use App\Entities\Locate\Ward\Traits\WardRelationship;
use App\Entities\Locate\Ward\Traits\WardScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Ward extends Model implements Transformable
{
    use TransformableTrait, HasFactory, WardRelationship, WardScope;

    protected $table = 'wards';

    protected $fillable = [
        'district_id',
        'code',
        'ward_name'
    ];
}
