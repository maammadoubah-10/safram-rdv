<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DossiersMedicaux extends Model
{

    use HasFactory;

    protected $table = 'dossiers_medicaux';

    protected $fillable = [
        'user_id', // Mettez à jour la colonne à partir de 'patient_id' à 'user_id'
        'medecin_id',
        'antecedents_medicaux',
        'allergies',
        'informations_medicales',
        'notes_consultation',
        'ordonnance',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Mettez à jour la relation avec la nouvelle colonne
    }

    public function medecin()
    {
        return $this->belongsTo(Medecin::class, 'medecin_id');
    }
}
