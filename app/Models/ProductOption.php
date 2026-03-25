<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{
    use HasFactory;

     protected $fillable = ['product_id','name_ar','name_en','price','price_unit_ar','price_unit_en','sort_order'];

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
