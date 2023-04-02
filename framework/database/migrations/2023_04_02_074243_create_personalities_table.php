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
        Schema::create('personalities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('actors_id');
            $table->unsignedBigInteger('programs_id');
            $table->timestamps();
            $table->unique(["actors_id", "programs_id"], "idx_personalities_pk");
            $table->foreign('actors_id')->references('id')->on('actors')->onDelete('cascade');
            $table->foreign('programs_id')->references('id')->on('programs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personalities');
    }
};
