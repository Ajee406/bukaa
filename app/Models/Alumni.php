<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    protected $table = 'alumnus';

    protected $fillable = [
        'tenant_id',
        'user_id',
        'batch_id',
        'department_id',
        'passing_year_id',
        'id_number',
        'company',
        'company_designation',
        'company_address',
        'file',
        'blood_group',
        'date_of_birth',
        'gender',
        'about_me',
        'linkedin_url',
        'facebook_url',
        'twitter_url',
        'instagram_url',
        'city',
        'state',
        'zip',
        'country',
        'address',
        'custom_fields'
    ];

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }

    public function batch(){
        return $this->belongsTo(Batch::class, 'batch_id');
    }
    public function department(){
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function passing_year(){
        return $this->belongsTo(PassingYear::class, 'passing_year_id');
    }
}
