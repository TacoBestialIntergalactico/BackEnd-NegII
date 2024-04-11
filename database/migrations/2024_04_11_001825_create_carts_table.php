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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->integer("Quantity");
            $table->unsignedBigInteger("IdUserFk");
            $table->unsignedBigInteger('IdProductFk');
            $table->timestamps();

            $table->foreign('IdProductFk')->references('id')->on('products');
            $table->foreign('IdUserFk')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
