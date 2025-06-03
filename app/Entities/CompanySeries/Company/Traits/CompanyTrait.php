<?php

namespace App\Entities\CompanySeries\Company\Traits;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Traits\TransformableTrait;

trait CompanyTrait
{
    use TransformableTrait, HasFactory, Sluggable, SoftDeletes,
        CompanyRelationship, CompanyScope;

    /**
     * @return array[]
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true
            ]
        ];
    }
}
