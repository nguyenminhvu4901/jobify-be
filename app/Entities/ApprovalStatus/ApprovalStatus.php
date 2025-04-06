<?php

namespace App\Entities\ApprovalStatus;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ApprovalStatus extends BaseModel implements Transformable
{
    use TransformableTrait, HasFactory;

    protected $table = 'approval_statuses';

    public const FILLABLE_FIELDS = [
        'status'
    ];
}
