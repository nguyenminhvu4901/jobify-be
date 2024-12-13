<?php

namespace App\Entities\Company;

use App\Entities\Company\Traits\CompanyRelationship;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Company extends Model implements Transformable
{
    use TransformableTrait, HasFactory, Sluggable, SoftDeletes,
        CompanyRelationship;

    protected $table = 'companies';

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'company_scale_id',
        'gender_id',
        'website',
        'description',
        'tax_code',
        'avatar'
    ];

    /**
     * @return array[]
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
