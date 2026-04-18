<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['title_ar','title_en','title_fr','thumbnail','video_url','duration','is_active','sort_order'];

    public function scopeActive($q)
    {
        return $q->where('is_active', 1)->orderBy('sort_order');
    }
}
