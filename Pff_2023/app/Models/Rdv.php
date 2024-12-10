<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rdv extends Model
{
    use HasFactory;

    protected $table = 'rdv'; // Assurez-vous que le modèle est associé à la table "rdv".

    protected $fillable = [
        'user_id',
        'medecin_id',
        'disponibilite_id',
        'date',
        'heure_debut',
        'heure_fin',
        'description',
        'statut',
    ];
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function disponibilite()
    {
        return $this->belongsTo(Disponibilite::class, 'disponibilite_id');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'user_id');
    }

    
    public function medecin()
    {
        return $this->belongsTo(Medecin::class, 'medecin_id');
    }


}

