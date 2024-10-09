<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommitteeDesignation extends Model
{
    use SoftDeletes;

    protected $fillable =
        [
            'tenant_id',
            'name',
            'status',
            'order'
        ];
}
