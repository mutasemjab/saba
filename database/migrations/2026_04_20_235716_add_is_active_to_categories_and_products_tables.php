<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->after('name_fr');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->boolean('is_active')->default(true)->after('is_featured');
        });
    }

    public function down()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });
    }
};
