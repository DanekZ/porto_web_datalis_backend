<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $fillable = [
        'title',
        'issuer',
        'type',
        'level',
        'image',
        'image_path',
        'credential_url',
        'credential_id',
        'issue_date',
        'expiration_date',
        'categories',
        'year',
        'sort_order',
    ];

    protected $casts = [
        'categories'       => 'array',
        'issue_date'       => 'date:Y-m-d',
        'expiration_date'  => 'date:Y-m-d',
    ];
}