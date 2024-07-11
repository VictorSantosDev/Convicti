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
        Schema::create('address', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('point_of_sale_id');
            $table->string('street', 255);
            $table->string('neighborhood', 255);
            $table->string('state', 100);
            $table->string('city', 100);
            $table->string('number', 50);
            $table->string('complement', 255);
            $table->string('postal_code', 20);
            $table->timestamps();
            $table->index('id');

            $table->foreign('point_of_sale_id')->references('id')->on('point_of_sale');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('address');
    }
};
