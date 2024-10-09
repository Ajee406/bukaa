<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommitteeCandidateFlag extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'tenant_id',
        'committee_category_id',
        'committee_election_id',
        'flag',
        'name',
        'status',
    ];
}
