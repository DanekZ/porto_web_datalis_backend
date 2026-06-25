<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $fillable = [
        'title',
        'issuer',
        'type',
        'image',
        'credential_url',
        'year',
        'sort_order',
    ];
}