<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">    

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
            
            border-radius: 10px;
            border: 4px double #fff;
            text-align: center;
            cursor: pointer;
            color: #fff;
            margin-left : 20px;
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

        h2{
            color: #007BFF;
            font-weight: bold;
            font-size: 2em;
            font-style: italic;
            text-transform: uppercase;
            text-align: center;
        }
        a{
            text-decoration: none;
            color: white;
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

        .rendezvous-container {
            display: flex;
            flex-direction: row; /* Alignement de gauche à droite */
            flex-wrap: wrap; /* Passage à la ligne en cas de dépassement de la largeur */
            justify-content: flex-start; /* Début de la ligne */
            align-items: flex-start; /* Alignement du haut vers le bas */
            gap: 20px; /* Espace entre les rendez-vous */
            margin-left: 50px;
        }

        .rendezvous-item {
            border: 2px solid #007BFF;
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 20px; /* Espace entre les blocs de rendez-vous */
            width: 300px; /* Ajustez la largeur selon vos besoins */
        }

        .rendezvous-item strong {
            font-weight: bold;
            color: #007BFF;
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
            margin-left : 300px;
        }

        .BS{
            width : 300px;
            height: 30px;
            border-radius: 10px;
            cursor: pointer;
            font-weight: bold;
            font-style: italic;
            text-transform: uppercase;
            
        }
        
        .a1{
            margin-left : 30px;
            color: green;
        }
        .a2{
            margin-left : 40px;
            color: red;
        }

    </style>
</head>
<body>

<div class="navbar">
        <h1 class="m-0 text-uppercase text-primary"><i class="fa fa-clinic-medical me-2"></i>&nbsp SAFRAM</h1>
        
        <div class="message">
            <a href="{{ route('medecin.compte.profil') }}"  class="accueil"><button><i class="bi bi-person-circle"></i> &nbsp Gérer mon compte</button></a>
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
        <br><br><br><br><br><br><br><br><br>
    
    <h2>Historique des rendez-vous</h2>
    

    <div class="rendezvous-container">
        @foreach ($mesRendezVous as $rendezVous)
        
            <div class="rendezvous-item">
            <p>Nom du patient: <strong>{{ $rendezVous->user->name }}</strong></p>
                <p>Date : {{ $rendezVous->date }}</p>
                <p>Heure de début : {{ $rendezVous->heure_debut }}</p> 
                <p>Heure de fin : {{ $rendezVous->heure_fin }}</p> 
                <p>Description :{{ $rendezVous->description }}</p> 
                <p>Statut : <strong>{{ $rendezVous->statut }}</strong></p> 

                    <p class="BS"><a class="a1" href="{{ route('confirm-rdv', ['id' => $rendezVous->id]) }}">Confirmer</a> <a class="a2" href="{{ route('reject-rdv', ['id' => $rendezVous->id]) }}">Refuser</a></p>
                    
            </div>
        
            <br><br>
        @endforeach
        </div>

        <footer class="footer">
        <div class="container">
            <p>&copy; 2023 &nbsp <i class="fa fa-clinic-medical me-2"></i>&nbsp SAFRAM. Tous droits réservés.</p>
        </div>
    </footer>

</body>
</html>