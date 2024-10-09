<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'tenant_id',
        'title',
        'slug',
        'image',
        'video_url',
        'campaign_category_id',
        'goal',
        'location',
        'start_date',
        'deadline',
        'details',
        'minimum_amount',
        'created_by',
        'status',
    ];

    public function category(){
        return $this->belongsTo(CampaignCategory::class, 'campaign_category_id');
    }

    public function payments()
    {
        return $this->morphMany(Payment::class, 'paymentable');
    }

    public function donations(){
        return $this->hasMany(CampaignDonation::class, 'campaign_id')->where('status', STATUS_ACTIVE);
    }

    public function comments(){
        return $this->hasMany(CampaignComment::class, 'campaign_id')->whereNull('campaign_comment_id')->where('status', STATUS_ACTIVE);
    }
}
