<?php

namespace App\Entities\CompanySeries\Company;

use App\Entities\CompanySeries\Company\Traits\CompanyRelationship;
use App\Entities\CompanySeries\Company\Traits\CompanyScope;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Company extends Model implements Transformable
{
    use TransformableTrait, HasFactory, Sluggable, SoftDeletes,
        CompanyRelationship, CompanyScope;

    protected $table = 'companies';

    public const FILLABLE_FIELDS = [
        'user_id',
        'name',
        'slug',
        'company_scale_id',
        'company_working_day_id',
        'gender_id',
        'status_id',
        'website',
        'description',
        'tax_code',
        'avatar'
    ];

    protected $fillable = self::FILLABLE_FIELDS;

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
