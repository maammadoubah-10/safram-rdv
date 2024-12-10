<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dossiers_medicaux', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(); // Clé étrangère vers la table 'users'
            $table->foreignId('medecin_id')->constrained(); // Clé étrangère vers la table des médecins (ajoutez le nom de la table si vous l'avez)
            $table->text('antecedents_medicaux')->nullable();
            $table->text('allergies')->nullable();
            $table->text('informations_medicales')->nullable();
            $table->text('notes_consultation')->nullable();
            $table->text('ordonnance')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dossiers_medicaux');
    }
    
};
