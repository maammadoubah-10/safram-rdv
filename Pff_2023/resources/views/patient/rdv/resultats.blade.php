
@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Résultats de la Recherche</h1>

    @if ($medecins->isEmpty())
        <p class="alert alert-info">Aucun médecin trouvé pour votre recherche.</p>
    @else

        <div class="list-group">
            @foreach ($medecins as $medecin)
                <div class="list-group-item">
                    <h5 class="mb-1">Nom : {{ $medecin->name }}</h5>
                    <p class="mb-1">Prénom : {{ $medecin->lastName }}</p>
                    <p class="mb-1">Spécialité : {{ $medecin->specialite->nom }}</p>
                    <p class="mb-1">Adresse : {{ $medecin->adresse }}</p>
                    <p class="mb-1">Téléphone : {{ $medecin->tel }}</p>
                    <p class="mb-1">Prix de visite : {{ $medecin->prixVisite }}</p>
                    <p class="mb-1">Lieu de visite : {{ $medecin->lieu }}</p>
                    <a href="{{ route('afficher-disponibilites', ['medecin' => $medecin->id]) }}" class="btn btn-primary">Voir ses disponibilités</a>
                </div>
            @endforeach
        </div>

    @endif
</div>
@endsection
