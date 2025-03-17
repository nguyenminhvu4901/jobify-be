<?php

namespace App\Entities\CompanyWorkingDay;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class CompanyWorkingDay extends Model implements Transformable
{
    use TransformableTrait, HasFactory;

    protected $table = "company_working_days";

    protected $fillable = [
        'working_day'
    ];

    /**
     * @return Attribute
     */
    protected function workingDay(): Attribute
    {
        return Attribute::make(
            get: function (string $value) {
                if (str_contains($value, '_')) {
                    return __('data/working_days.' . $value) ?? $value;
                }

                return $value;
            }
        );
    }
}
