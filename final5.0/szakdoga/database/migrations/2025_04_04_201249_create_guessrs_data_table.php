<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('guessrs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('player_id');
            $table->float('score');
            $table->timestamps();
    
            $table->foreign('player_id')->references('id')->on('players')->onDelete('cascade');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('guessrs');
    }
};
