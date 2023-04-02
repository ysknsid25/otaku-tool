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
        Schema::create('notifyprograms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('programs_id');
            $table->timestamps();
            $table->unique(["users_id", "programs_id"], "idx_notifyprograms_pk");
            $table->foreign('users_id')->references('id')->on('users')->unique()->onDelete('cascade');
            $table->foreign('programs_id')->references('id')->on('programs')->unique()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifyprograms');
    }
};
