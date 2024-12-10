@foreach($rdvsGrouped as $userId => $rdvs)
    <div>
        <!-- Utilisez le nom du patient directement à partir du RDV -->
        @php $patient = $rdvs->first()->user; @endphp
        <h2>Nom du Patient: {{ $patient->name }}</h2>

        @php $medicalRecordCreated = false; @endphp

        @foreach ($rdvs as $rdv)
            <!-- Utilisez la variable $rdv->user pour accéder au patient -->
            @php $patient = $rdv->user; @endphp

            <!-- Set the flag to true if the medical record exists for this patient -->
            @php $medicalRecordExists = $patient->dossiersMedicaux(auth()->user()->id)->exists(); @endphp

            <!-- Affichez le lien vers le dossier médical -->
            @if (!$medicalRecordCreated)
                @if ($medicalRecordExists)
                    <a href="{{ route('medecin.dossier-medical', ['user' => $patient->id]) }}">Afficher Dossier Médical</a>
                @else
                    <a href="{{ route('medecin.create-dossier-medical', ['patientId' => $patient->id]) }}">Créer Dossier Médical</a>
                @endif

                <!-- Set the flag to true to indicate that the medical record has been created for this patient -->
                @php $medicalRecordCreated = true; @endphp
            @endif
        @endforeach
    </div>
@endforeach
