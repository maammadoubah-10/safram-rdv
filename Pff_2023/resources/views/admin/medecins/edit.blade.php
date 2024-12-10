<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Médecins</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    
    <style>
    .navbar {
            background-color: #007BFF;
            color: #fff;
            padding: 20px;
            display: flex;
            align-items: center;
            position: fixed;
            width: 100%;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;
        }

        .navbar .icon {
            font-size: 24px;
            margin-right: 10px;
        }
        .navbar .message button{
            margin-left: 20px;
            border-radius: 10px;
            border: 4px double #fff;
            text-align: center;
            cursor: pointer;
            color: #fff;

        }

        .accueil{
            margin-left : 750px;
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            font-style: italic;
            text-transform: uppercase;
        }

        .DC{
            margin-left : 20px;
            background-color: red;
            color: #fff;
            border-radius: 10px;
            border: 4px double #fff;
            text-align: center;
            cursor: pointer;
        }

        button{
            background-color: #007BFF;
            width : 150px;
            height: 50px;
            border-radius: 10px;
            cursor: pointer;
        }

        .button{
            background-color: #007BFF;
            width : 200px;
            height: 50px;
            border-radius: 10px;
            cursor: pointer;
        }
        .button a{
            color: #fff;
            font-weight: bold;
            font-style: italic;
            text-transform: uppercase;
        }
        .BM{
            background-color: #007BFF;
            width : 150px;
            height: 50px;
            border-radius: 10px;
            cursor: pointer;
            color: #fff;
            font-weight: bold;
            font-style: italic;
            text-transform: uppercase;
            margin-left : 250px;
        }

        form{
            margin-left : 50px;
        }

        h2{
            color: #007BFF;
            font-weight: bold;
            font-size: 2em;
            font-style: italic;
            text-transform: uppercase;
            text-align:center;

        }
        strong{
            text-transform: uppercase;
        }
        a{
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            font-style: italic;
            text-transform: uppercase;
        }

        /* Style pour le pied de page */
        .footer {
            background-color: #007BFF;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            position: absolute;
            bottom: 0;
            width: 100%;
            font-style: italic;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;

        }

        /* Style pour le texte du pied de page */
        .footer p {
            margin: 0;
        }

        .table{

            margin-left : 100px;
        }
        .form-group{
            margin-left : 150px;
        }


        .rendezvous-container {
            display: flex;
            flex-direction: row; /* Alignement de gauche à droite */
            flex-wrap: wrap; /* Passage à la ligne en cas de dépassement de la largeur */
            justify-content: flex-start; /* Début de la ligne */
            align-items: flex-start; /* Alignement du haut vers le bas */
            gap: 20px; /* Espace entre les rendez-vous */
            margin-left : 340px;
        }

        .rendezvous-item {
            border: 5px solid #007BFF;
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 20px; /* Espace entre les blocs de rendez-vous */
            width: 800px; /* Ajustez la largeur selon vos besoins */
        }

        .rendezvous-item strong {
            font-weight: bold;
            color: #007BFF;
        }

    </style>
</head>
<body>
    
<div class="navbar">
        <h1 class="m-0 text-uppercase text-primary"><i class="fa fa-clinic-medical me-2"></i>&nbsp SAFRAM</h1>

        <div class="message">
            <a href="{{ route('admin.mon-compte') }}"  class="accueil"><button><i class="bi bi-person-circle"></i> &nbsp Gérer mon compte</button></a>
        </div>
        
        <div class="message">
            <a href="{{ route('messages.index') }}"><button><i class="bi bi-envelope"></i> &nbsp Messagerie</button></a>
        </div>

        <div>
            <button  class="DC">
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
            </button>

            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
            </form>
        </div>

    </div>

    <br><br><br><br><br><br><br>

    <h2>Modifier les informations de {{ old('name', $medecin->name) }} {{ old('lastName', $medecin->lastName) }}</h2>
    <div class="rendezvous-container">
    <div class="rendezvous-item">
    <form method="POST" action="{{ route('admin.medecin.update', ['id' => $medecin->id]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <br>
        <div class="form-group">
            <label for="image">Image du Médecin</label>
            <input type="file" class="form-control-file" id="image" name="image">
        </div><br>
        
        <div class="form-group">
            <label for="name">Prénom du Médecin</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $medecin->name) }}" required>
        </div><br>
        
        <div class="form-group">
            <label for="lastName">Nom du Médecin</label>
            <input type="text" class="form-control" id="lastName" name="lastName" value="{{ old('lastName', $medecin->lastName) }}" required>
        </div><br>

        <div class="form-group">
            <label for="adresse">Adresse</label>
            <input type="text" class="form-control" id="adresse" name="adresse" value="{{ old('adresse', $medecin->adresse) }}" required>
        </div><br>

        <div class="form-group">
            <label for="specialite_id">Spécialité</label>
            <select class="form-control" id="specialite_id" name="specialite_id" required>
                @foreach($specialites as $specialite)
                    <option value="{{ $specialite->id }}" {{ $medecin->specialite_id == $specialite->id ? 'selected' : '' }}>
                        {{ $specialite->nom }}
                    </option>
                @endforeach
            </select>
        </div><br>

        <div class="form-group">
            <label for="tel">Numéro de téléphone</label>
            <input type="text" class="form-control" id="tel" name="tel" value="{{ old('tel', $medecin->tel) }}" required>
        </div><br>

        <div class="form-group">
            <label for="prixVisite">Prix de la Visite</label>
            <input type="text" class="form-control" id="prixVisite" name="prixVisite" value="{{ old('prixVisite', $medecin->prixVisite) }}" required>
        </div><br>

        <div class="form-group">
            <label for="lieu">Lieu</label>
            <input type="text" class="form-control" id="lieu" name="lieu" value="{{ old('lieu', $medecin->lieu) }}" required>
        </div><br>

        <button type="submit" class="BM">Enrégistrer</button>
    </form>
    </div>
    </div>
    <footer class="footer">
        <div class="container">
            <p>&copy; 2023 &nbsp <i class="fa fa-clinic-medical me-2"></i>&nbsp SAFRAM. Tous droits réservés.</p>
        </div>
    </footer>

</body>
</html>