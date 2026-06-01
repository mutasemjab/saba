<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('address_ar')->after('email')->nullable();
            $table->string('address_en')->after('address_ar')->nullable();
            $table->string('address_fr')->after('address_en')->nullable();
        });

        // Migrate existing address data into address_ar
        DB::table('settings')->update(['address_ar' => DB::raw('`address`')]);

        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('address');
        });
    }

    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('address')->after('email')->nullable();
        });

        DB::table('settings')->update(['address' => DB::raw('`address_ar`')]);

        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['address_ar', 'address_en', 'address_fr']);
        });
    }
};
