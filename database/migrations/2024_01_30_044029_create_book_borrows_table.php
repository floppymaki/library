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
        Schema::create('book_borrows', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('book_copy_id');
            $table->date('checked_out_at');
            $table->date('checked_in_at')->nullable();
            $table->date('return_date');     
            
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('book_copy_id')->references('id')->on('book_copies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_borrows');
    }
};
