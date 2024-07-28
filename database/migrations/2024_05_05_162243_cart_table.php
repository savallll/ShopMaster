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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            // $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('cart_products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('quantity');
            $table->integer('cart_id');
            $table->integer('product_id');
            // $table->foreign('product_id')->references('id')->on('products');
            // $table->foreign('cart_id')->references('id')->on('carts');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('carts');
        Schema::dropIfExists('cart_products');


    }
};
