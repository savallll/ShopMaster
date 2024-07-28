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
        //
        Schema::create('province', function (Blueprint $table) {
            $table->id('province_id');
            $table->string('name')->nullable();
        });

        Schema::create('district', function (Blueprint $table) {
            $table->id('district_id');
            $table->integer('province_id');
            $table->string('name')->nullable();
        });

        Schema::create('wards', function (Blueprint $table) {
            $table->id('wards_id');
            $table->integer('district_id');
            $table->string('name')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('province');
        Schema::dropIfExists('district');
        Schema::dropIfExists('wards');


    }
};
