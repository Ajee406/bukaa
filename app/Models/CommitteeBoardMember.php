<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommitteeBoardMember extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'committee_election_id',
        'user_id',
        'tenant_id',
        'committee_designation_id',
        'photo',
        'company',
        'address',
        'created_by',
        'status',
    ];

    public function election()
    {
        return $this->belongsTo(CommitteeElection::class, 'committee_election_id');
    }

    public function designation()
    {
        return $this->belongsTo(CommitteeDesignation::class, 'committee_designation_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
