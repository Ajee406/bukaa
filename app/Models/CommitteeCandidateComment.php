<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommitteeCandidateComment extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'tenant_id',
        'user_id',
        'committee_candidate_id',
        'committee_candidate_comment_id',
        'comment',
        'status',
    ];

    public function replies(){

        return $this->hasMany(CommitteeCandidateComment::class, 'committee_candidate_comment_id')->where('status', STATUS_ACTIVE);
    }

    public function user(){

        return $this->belongsTo(User::class, 'user_id');
    }

    public function candidate(){

        return $this->belongsTo(CommitteeCandidate::class, 'committee_candidate_id');
    }


}
