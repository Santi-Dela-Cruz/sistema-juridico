<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'identification_type',
        'person_type',
        'identification_number',
        'address',
        'phone_number',
        'email',
        'is_active',
        'registered_at',
        'marital_status',
        'legal_representative',
        'fiscal_address',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'registered_at' => 'datetime',
    ];
}
