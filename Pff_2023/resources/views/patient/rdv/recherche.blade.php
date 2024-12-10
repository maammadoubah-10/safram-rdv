@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Rechercher un Médecin</h1>
    <form action="{{ route('patient.rdv.resultats') }}" method="GET">
        <div class="form-group">
            <label for="search">Rechercher par nom ou prénom :</label>
            <input type="text" name="search" id="search" class="form-control" placeholder="Entrez un nom ou prénom">
        </div>
        <button type="submit" class="btn btn-primary">Rechercher</button>
    </form>
</div>
@endsection
