<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
            $table->integer('province_id')->default(0)->nullable()->after('category_id');
            $table->integer('district_id')->default(0)->nullable()->after('category_id');
            $table->integer('ward_id')->default(0)->nullable()->after('category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
           $table->dropColum(['province_id','district_id','ward_id']);
        });
    }
};
