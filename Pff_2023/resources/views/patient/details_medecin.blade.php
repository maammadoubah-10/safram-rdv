@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Détails du Médecin</h1>
    <div class="card">
        <div class="card-body">
            <img src="{{ $medecin->image ? asset('storage/' . $medecin->image) : asset('images/default.jpg') }}" alt="{{ $medecin->name }}">
            <h2>{{ $medecin->name }} {{ $medecin->lastName }}</h2>
            <p>Spécialité : {{ $medecin->specialite->nom }}</p>
            <p>Adresse : {{ $medecin->adresse }}</p>
            <p>Téléphone : {{ $medecin->tel }}</p>
            <p>Prix de la visite : {{ $medecin->prixVisite }} €</p>
            <p>Lieu : {{ $medecin->lieu }}</p>
        </div>
    </div>
</div>
@endsection
