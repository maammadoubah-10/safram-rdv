<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profil',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function medecin()
    {
        return $this->hasOne(Medecin::class, 'user_id');
    }

    public function isMedecin()
    {
        return $this->medecin !== null;
    }

    public function isPatient()
    {
        return $this->profil === 'Patient'; 
    }

    public function isAdmin()
    {
        return $this->profil === 'Admin'; // Vérifie si le champ 'profil' de l'utilisateur est égal à 'Admin'.
    }

    public static function adminExists()
    {
        return static::where('profil', 'Admin')->exists();
    }

    public function specialite()
    {
        return $this->hasOne(Specialite::class, 'id', 'specialite_id');
    }

    public function rdvs()
    {
        return $this->hasMany(Rdv::class, 'user_id', 'id');
    }


    // User.php
    public function dossiersMedicaux()
    {
        return $this->hasMany(dossiersMedicaux::class, 'user_id');
    }

    public function hasDossierMedical()
    {
        return $this->dossiersMedicaux()->exists();
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }


}
