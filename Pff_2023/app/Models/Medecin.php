<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medecin extends Model
{
    use HasFactory;

    protected $table = 'medecins';

    protected $fillable = [
        'name',
        'lastName',
        'adresse',
        'tel',
        'lieu',
        'prixVisite',
        'specialite_id',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function disponibilites()
    {
        return $this->hasMany(Disponibilite::class, 'user_id');
    }

    public function specialite()
    {
        return $this->belongsTo(Specialite::class, 'specialite_id');
    }



    public function rdv()
    {
        return $this->hasMany(Rdv::class, 'medecin_id');
    }
    
    public function dossiersMedicaux()
    {
        return $this->hasMany(DossierMedical::class, 'medecin_id');
    }


}
