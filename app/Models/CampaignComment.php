<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CampaignComment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'tenant_id',
        'user_id',
        'campaign_id',
        'campaign_comment_id',
        'comment',
        'status',
    ];

    public function replies(){
        return $this->hasMany(CampaignComment::class, 'campaign_comment_id')->where('status', STATUS_ACTIVE);
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function campaign(){
        return $this->belongsTo(Campaign::class, 'campaign_id');
    }
}
