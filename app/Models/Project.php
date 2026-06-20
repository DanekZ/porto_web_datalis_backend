<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'category',
        'description',
        'role',
        'tech_stack',
        'github_url',
        'demo_url',
    ];

    public function images()
    {
        return $this->hasMany(ProjectImage::class)->orderBy('order');
    }
}