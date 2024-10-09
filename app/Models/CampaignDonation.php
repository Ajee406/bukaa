<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CampaignDonation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'tenant_id',
        'campaign_id',
        'user_id',
        'name',
        'email',
        'phone',
        'country',
        'postal_code',
        'comment',
        'payment_id',
        'amount',
        'donation_type_anonymous',
        'status',
    ];

    public function campaign(){
        return $this->belongsTo(Campaign::class, 'campaign_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function payment(){
        return $this->belongsTo(Payment::class, 'payment_id');
    }
}
