
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('rdv', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('medecin_id');
        $table->unsignedBigInteger('disponibilite_id');
        $table->date('date');
        $table->time('heure_debut');
        $table->time('heure_fin');
        $table->text('description')->nullable();
        $table->enum('statut', ['confirmé', 'en attente', 'refusé'])->default('en attente');
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users');
        $table->foreign('medecin_id')->references('id')->on('medecins');
        $table->foreign('disponibilite_id')->references('id')->on('disponibilites')->onDelete('cascade');

    });
}


    public function down()
    {
        Schema::dropIfExists('rdv');
    }
};
