<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommitteeVote extends Model
{
    protected $fillable = [
        'tenant_id',
        'committee_election_id',
        'committee_category_id',
        'committee_designation_id',
        'committee_candidate_id',
        'user_id',
        'status',
    ];

}
