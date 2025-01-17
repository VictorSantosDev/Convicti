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
        Schema::create('point_of_sale', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('board_id');
            $table->string('name', 100);
            $table->string('latitude', 30);
            $table->string('longitude', 30);
            $table->timestamps();
            $table->index('id');
            $table->index('board_id');

            $table->foreign('board_id')->references('id')->on('board');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('point_of_sale');
    }
};
