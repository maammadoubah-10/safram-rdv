<!-- resources/views/medecin/edit-dossier-medical.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Modifier le dossier médical de {{ $patient->name }}</h1>

        <form method="post" action="{{ route('medecin.update-dossier-medical', ['patientId' => $patient->id]) }}">
            @csrf
            @method('PUT')

            <!-- Ajoutez les champs du formulaire pour la modification du dossier médical -->
<div class="form-group">
    <label for="antecedents_medicaux">Antécédents médicaux:</label>
    <textarea name="antecedents_medicaux" class="form-control">{{ $dossierMedical->antecedents_medicaux }}</textarea>
</div>

<div class="form-group">
    <label for="allergies">Allergies:</label>
    <textarea name="allergies" class="form-control">{{ $dossierMedical->allergies }}</textarea>
</div>

<div class="form-group">
    <label for="informations_medicales">Informations médicales:</label>
    <textarea name="informations_medicales" class="form-control">{{ $dossierMedical->informations_medicales }}</textarea>
</div>

<div class="form-group">
    <label for="notes_consultation">Notes de consultation:</label>
    <textarea name="notes_consultation" class="form-control">{{ $dossierMedical->notes_consultation }}</textarea>
</div>

<div class="form-group">
    <label for="ordonnance">Ordonnance:</label>
    <textarea name="ordonnance" class="form-control">{{ $dossierMedical->ordonnance }}</textarea>
</div>

<!-- Ajoutez d'autres champs du formulaire selon vos besoins -->


            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
        </form>

        <a href="{{ route('medecin.dossiers-patients') }}">Retour aux dossiers patients</a>
    </div>
@endsection
