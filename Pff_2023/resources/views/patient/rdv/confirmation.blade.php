@extends('layouts.app')

@section('content')
    <h1>Rendez-vous réservé avec succès</h1>
    <p>Merci d'avoir réservé votre rendez-vous. Nous avons enregistré votre demande avec succès.
    Vous serez contacté pour confirmer la date et l'heure du rendez-vous 
    une fois que votre réservation sera confirmée par le médecin.</p>
    <a href="{{ route('home') }}">Retour à l'accueil</a>
    @endsection

    