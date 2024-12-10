<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <!-- Barre de recherche à droite de l'espace non occupé -->
        <div class="search-bar">
            <form action="{{ route('patient.recherche-medecin') }}" method="GET">
                <input type="text" name="specialite" placeholder="Rechercher un médecin par spécialité">
                <button type="submit">Rechercher</button>
            </form>
        </div>
</body>
</html>
