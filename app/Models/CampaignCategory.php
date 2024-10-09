<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CampaignCategory extends Model
{
    use SoftDeletes;

    protected $fillable = ['tenant_id', 'name', 'slug', 'status'];

    public function campaigns(){
        return $this->hasMany(Campaign::class)->where('status', STATUS_ACTIVE);
    }
}
