<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    // Le nom de la table associée au modèle.
    protected $table = 'patients';

    // Les attributs qui sont attribuables.
    protected $fillable = [
        'nom',
        'prenom',
        'date_de_naissance',
        'sexe',
        'adresse',
        'numero_telephone',
        'contacts_urgence',
        'user_id',
    ];

    public function user()
    {
       return $this->belongsTo(User::class, 'user_id');
    }
    public function dossiersMedicaux()
    {
        return $this->hasMany(DossierMedical::class, 'patient_id');
    }
}
