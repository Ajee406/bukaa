<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Committee extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'committee_election_id',
        'user_id',
        'tenant_id',
        'committee_designation_id',
        'committee_category_id',
        'photo',
        'company',
        'address',
        'created_by',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
