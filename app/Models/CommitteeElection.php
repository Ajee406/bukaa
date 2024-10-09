<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommitteeElection extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'tenant_id',
        'title',
        'session',
        'vote_start_date',
        'vote_end_date',
        'status',
        'details',
        'is_result_done',
    ];
}
