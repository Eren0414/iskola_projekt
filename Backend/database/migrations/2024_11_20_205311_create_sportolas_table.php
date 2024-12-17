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
        Schema::create('sportolas', function (Blueprint $table) {
            $table->Integer('diakokId')->unsigned();
            $table->Integer('sportokId')->unsigned();
            $table->foreign('diakokId')->references('id')->on('diaks');
            $table->foreign('sportokId')->references('id')->on('sports');
            $table->primary(['diakokId', 'sportokId']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sportolas');
    }
};
