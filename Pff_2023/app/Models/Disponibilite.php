<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disponibilite extends Model
{
    protected $table = 'disponibilites'; // Mettez à jour le nom de la table
    protected $fillable = [
        'user_id', // Ajoutez user_id ici
        'date_disponibilite',
        'heure_debut',
        'heure_de_fin',
        'disponible',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function rdv()
    {
        return $this->hasOne(Rdv::class, 'disponibilite_id');
    }


}
