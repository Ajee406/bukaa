<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsSubscriptionLetter extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'tenant_id',
        'email',
        'status'
    ];
}
