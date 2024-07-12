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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('point_of_sale_id');
            $table->unsignedBigInteger('near_point_of_sale_id')->nullable();
            $table->string('sale_values', 10);
            $table->date('date');
            $table->time('hour');
            $table->integer('km_point_of_sale_main');
            $table->integer('km_near_point_of_sale');
            $table->string('latitude', 30);
            $table->string('longitude', 30);
            $table->boolean('is_roaming')->default(0);
            $table->timestamps();
            $table->index('id');
            $table->index('user_id');
            $table->index('point_of_sale_id');
            $table->index('near_point_of_sale_id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('point_of_sale_id')->references('id')->on('point_of_sale');
            $table->foreign('near_point_of_sale_id')->references('id')->on('point_of_sale');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
