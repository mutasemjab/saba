<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// شغّل هاد الـ migration بس إذا ما كان عندك price بعد في جدول products
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('price', 8, 2)->nullable()->after('is_featured');
            $table->string('price_unit_ar')->default('درهم')->after('price');
            $table->string('price_unit_en')->default('MAD')->after('price_unit_ar');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['price', 'price_unit_ar', 'price_unit_en']);
        });
    }
};
