<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar');
            $table->string('title_en');
            $table->string('title_fr');
            $table->string('thumbnail');           // مسار الصورة في uploads
            $table->string('video_url')->nullable(); // رابط يوتيوب / فيميو
            $table->string('duration')->nullable();  // مثال: ٨:٢٤
            $table->tinyInteger('is_active')->default(1); // 1=ظاهر 0=مخفي
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
