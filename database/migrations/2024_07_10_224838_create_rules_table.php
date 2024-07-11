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
        Schema::create('rules', function (Blueprint $table) {
            $table->id();
            $table->enum('type', [
                'SELLER',
                'MANAGE',
                'BOARD',
                'GENERAL_BOARD',
            ]);
            $table->timestamps();
            $table->index('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rules');
    }
};
