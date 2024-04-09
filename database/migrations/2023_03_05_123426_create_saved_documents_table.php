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
        Schema::create('saved_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('template_id');
            $table->string('document_name');
            $table->string('language');
            $table->text('document');
            $table->integer('word_count');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents_save');
    }
};
