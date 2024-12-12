<?php

namespace App\Entities\BusinessSector;

use App\Entities\BusinessSector\Traits\BusinessSectorRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class BusinessSector extends Model implements Transformable
{
    use TransformableTrait, HasFactory, BusinessSectorRelationship;

    protected $table = 'business_sectors';

    protected $fillable = [
        'name',
        'description',
        'parent_id'
    ];
}
