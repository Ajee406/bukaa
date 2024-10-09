<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommitteeCandidate extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'committee_election_id',
        'committee_designation_id',
        'committee_category_id',
        'committee_nomination_form_id',
        'user_id',
        'photo',
        'payment_id',
        'tenant_id',
        'election_manifesto',
        'flag_id',
        'form_data',
        'reject_reason',
        'status',
        'is_win',
        'approved_by',
        'rejected_by',
    ];

    public function committee(){
        return $this->belongsTo(CommitteeCategory::class, 'committee_category_id');
    }

    public function approved_votes(){
        return $this->hasMany(CommitteeVote::class)->where('status', STATUS_ACTIVE);
    }

    public function total_votes(){
        return $this->hasMany(CommitteeVote::class);
    }

    public function election(){
        return $this->belongsTo(CommitteeElection::class, 'committee_election_id');
    }

    public function position(){
        return $this->belongsTo(CommitteeDesignation::class, 'committee_designation_id');
    }

    public function nomination(){
        return $this->belongsTo(CommitteeNominationForm::class, 'committee_nomination_form_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function payment(){
        return $this->belongsTo(Payment::class, 'payment_id');
    }

    public function flag(){
        return $this->belongsTo(CommitteeCandidateFlag::class, 'flag_id');
    }
    public function alumnus(){
        return $this->belongsTo(Alumni::class, 'user_id','user_id');
    }

    public function comments(){

        return $this->hasMany(CommitteeCandidateComment::class, 'committee_candidate_id')->whereNull('committee_candidate_comment_id')->where('status', STATUS_ACTIVE);
    }

}
