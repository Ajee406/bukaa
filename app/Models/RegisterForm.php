<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegisterForm extends Model
{
    protected  $fillable = [
        'tenant_id',
        'enable_batch',
        'enable_department',
        'enable_passing_year',
        'enable_role_number',
        'enable_attachment',
        'enable_date_of_birth',
        'enable_gender',
        'custom_fields',
    ];
}
