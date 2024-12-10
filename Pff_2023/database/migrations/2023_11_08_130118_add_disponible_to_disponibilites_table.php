<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('disponibilites', function (Blueprint $table) {
            $table->boolean('disponible')->default(true); // Ajoutez la colonne disponible
        });
    }
    
    public function down()
    {
        Schema::table('disponibilites', function (Blueprint $table) {
            $table->dropColumn('disponible'); // Supprimez la colonne disponible
        });
    }
    
};
