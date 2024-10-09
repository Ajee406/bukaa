<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommitteeNominationForm extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'committee_election_id',
        'committee_category_id',
        'committee_designation_id',
        'title',
        'tenant_id',
        'start_date',
        'end_date',
        'description',
        'created_by',
        'form',
        'amount',
        'status',
    ];

    public function payments()
    {
        return $this->morphMany(Payment::class, 'paymentable');
    }

    public function final_candidates()
    {
        return $this->hasMany(CommitteeCandidate::class)->where('status', STATUS_ACTIVE);
    }

    public function committee()
    {
        return $this->belongsTo(CommitteeCategory::class, 'committee_category_id')->where('status', STATUS_ACTIVE);
    }

    public function position()
    {
        return $this->belongsTo(CommitteeDesignation::class, 'committee_designation_id');
    }

}
