<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('working_hours', function (Blueprint $table) {
            $table->id();
            $table->string('day_ar');          // الاثنين – الثلاثاء
            $table->string('day_en');          // Monday – Tuesday
            $table->tinyInteger('day_index');  // 0=أحد ... 6=سبت (أدنى قيمة للمجموعة)
            $table->string('open_time')->nullable();   // 11:00
            $table->string('close_time')->nullable();  // 23:00
            $table->string('note_ar')->nullable();  // الغداء · العشاء
            $table->string('note_en')->nullable();  // Lunch · Dinner
            $table->tinyInteger('is_ramadan')->default(0); // صف رمضان الخاص
            $table->tinyInteger('is_active')->default(1);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('working_hours');
    }
};
