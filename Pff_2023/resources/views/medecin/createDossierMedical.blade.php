<!-- resources/views/medecin/createDossierMedicalForm.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Créer un dossier médical</div>

                    <div class="card-body">
                        <form method="post" action="{{ route('medecin.create-dossier-medical', ['patientId' => $patientId]) }}">
                            @csrf

                            {{-- Ajoutez les champs du formulaire ici --}}
                            <div class="form-group">
                                <label for="antecedents_medicaux">Antécédents médicaux</label>
                                <textarea name="antecedents_medicaux" class="form-control" rows="4"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="allergies">Allergies</label>
                                <textarea name="allergies" class="form-control" rows="4"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="informations_medicales">Informations médicales</label>
                                <textarea name="informations_medicales" class="form-control" rows="4"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="notes_consultation">Notes de consultation</label>
                                <textarea name="notes_consultation" class="form-control" rows="4"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="ordonnance">Ordonnance</label>
                                <textarea name="ordonnance" class="form-control" rows="4"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Créer Dossier Médical</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
