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
        Schema::create('diaks', function (Blueprint $table) {
            $table->Integer('id')->unsigned()->autoIncrement();
            $table->Integer('osztalyId')->unsigned();
            $table->foreign('osztalyId')->references('id')->on('osztalies'); //Idegen kulcs
            $table->string('nev', 50)->notNull();
            $table->boolean('neme')->default(true);
            $table->date('szuletett')->nullable();
            $table->string('helyseg', 50)->nullable();
            $table->decimal('osztondij', 10,2)->nullable();
            $table->float('atlag')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diaks');
    }
};
