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
        Schema::create('medecins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('lastName');
            $table->unsignedBigInteger('specialite_id');
            $table->string('adresse');
            $table->string('tel', 12);
            $table->double('prixVisite', 8, 2);
            $table->string('lieu');
            $table->timestamps();

            $table->foreign('specialite_id')->references('id')->on('specialites');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medecins');
    }
};
