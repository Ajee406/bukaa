<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommitteeCategory extends Model
{
    use SoftDeletes;

    protected $fillable =
        [
            'tenant_id',
            'name',
            'slug',
            'status',
            'showing_home_page'
        ];
}
