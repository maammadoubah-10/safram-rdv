@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Dossier médical de {{ $patient->name }}</h1>

        @if ($dossierMedical)
            <!-- Affichez ici les informations du dossier médical -->
            <p>Antécédents médicaux: {{ $dossierMedical->antecedents_medicaux }}</p>
            <p>Allergies: {{ $dossierMedical->allergies }}</p>
            <p>Informations médicales: {{ $dossierMedical->informations_medicales }}</p>
            <p>Notes de consultation: {{ $dossierMedical->notes_consultation }}</p>
            <p>Ordonnance: {{ $dossierMedical->ordonnance }}</p>
            <!-- Ajoutez d'autres champs du dossier médical -->

            <a href="{{ route('medecin.dossiers-patients') }}">Retour aux dossiers patients</a>

            <!-- Ajoutez un lien pour la modification du dossier médical -->
            <a href="{{ route('medecin.edit-dossier-medical', ['patientId' => $patient->id]) }}">Modifier Dossier Médical</a>
        @else
            <p>Aucun dossier médical trouvé pour ce patient.</p>
        @endif
    </div>
@endsection
