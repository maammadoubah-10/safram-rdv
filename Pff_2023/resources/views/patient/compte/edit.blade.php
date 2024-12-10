@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier mes informations</h1>
    <form method="POST" action="{{ route('patient.updateInfo') }}">
        @csrf
        @method('PUT')

        <!-- Champs de formulaire pour nom et prénom -->
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control" value="{{ $patient->nom }}">
        </div>

        <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text" name="prenom" id="prenom" class="form-control" value="{{ $patient->prenom }}">
        </div>

        <!-- Autres champs de formulaire pour les informations du patient -->
        <div class="form-group">
            <label for="date_de_naissance">Date de naissance</label>
            <input type="date" name="date_de_naissance" id="date_de_naissance" class="form-control" value="{{ $patient->date_de_naissance }}">
        </div>

        <div class="form-group">
            <label for="sexe">Sexe</label>
            <select name="sexe" id="sexe" class="form-control">
                <option value="Homme" @if($patient->sexe === 'Homme') selected @endif>Homme</option>
                <option value="Femme" @if($patient->sexe === 'Femme') selected @endif>Femme</option>
            </select>
        </div>

        <div class="form-group">
            <label for="adresse">Adresse</label>
            <input type="text" name="adresse" id="adresse" class="form-control" value="{{ $patient->adresse }}">
        </div>

        <div class="form-group">
            <label for="numero_telephone">Numéro de téléphone</label>
            <input type="text" name="numero_telephone" id="numero_telephone" class="form-control" value="{{ $patient->numero_telephone }}">
        </div>

        <div class="form-group">
            <label for="contacts_urgence">Contacts d'urgence</label>
            <input type="text" name="contacts_urgence" id="contacts_urgence" class="form-control" value="{{ $patient->contacts_urgence }}">
        </div>

        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
    </form>
</div>
@endsection
