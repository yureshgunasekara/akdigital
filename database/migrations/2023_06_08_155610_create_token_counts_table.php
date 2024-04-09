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
        Schema::create('token_counts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('count_date')->default(date('d-m-Y'));
            $table->integer('total_count');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('token_counts');
    }
};
