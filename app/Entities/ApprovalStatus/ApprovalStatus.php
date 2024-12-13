<?php

namespace App\Entities\ApprovalStatus;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ApprovalStatus extends Model implements Transformable
{
    use TransformableTrait, HasFactory;

    protected $table = 'approval_statuses';

    protected $fillable = ['status'];
}
