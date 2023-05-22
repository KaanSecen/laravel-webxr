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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->integer('template');
            $table->foreignId('category_id')->constrained('categories');
            $table->string('title');
            $table->string('intro')->nullable();
            $table->string('cover_image');
            $table->string('background_image')->nullable();
            $table->string('color');
            $table->string('sound')->nullable();
            $table->date('date');
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
