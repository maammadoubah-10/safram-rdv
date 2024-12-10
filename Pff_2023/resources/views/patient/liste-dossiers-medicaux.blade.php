<!-- resources/views/patient/liste-dossiers-medicaux.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Mes Dossiers Médicaux</h1>

        @if ($dossiersMedicaux->isEmpty())
            <p>Aucun dossier médical trouvé.</p>
        @else
            <ul>
                @foreach ($dossiersMedicaux as $dossierMedical)
                    <li>
                        <a href="{{ route('patient.voir-dossier-medical', ['dossierId' => $dossierMedical->id]) }}">
                            Dossier médical du {{ $dossierMedical->created_at->format('d/m/Y') }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
