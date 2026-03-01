<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkingHour extends Model
{
    protected $fillable = ['day_ar','day_en','day_index','open_time','close_time','note_ar','note_en','is_ramadan','is_active','sort_order'];

    public function scopeActive($q)
    {
        return $q->where('is_active', 1)->orderBy('sort_order');
    }
}
