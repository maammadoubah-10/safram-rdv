<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('disponibilites', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id'); // Mettez à jour le nom de la colonne
        $table->date('date_disponibilite');
        $table->time('heure_debut');
        $table->time('heure_de_fin');
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users'); // Mettez à jour la référence à la table "users"
    });
}


    public function down()
    {
        Schema::dropIfExists('disponibilite');
    }
};
