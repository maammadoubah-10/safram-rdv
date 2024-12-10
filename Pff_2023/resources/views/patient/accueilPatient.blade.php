<!DOCTYPE html>
<html>
<head>
    <title>Accueil Patient</title>
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
            margin-left: 950px;
            border-radius: 10px;
            border: 4px double #fff;
            width: 150px;
            text-align: center;
            cursor: pointer;
            color: #fff;
            font-weight: bold;
        }

        .DC{
            margin-left : 20px;
            background-color: red;
            color: #fff;
            border-radius: 10px;
            border: 4px double #fff;
            text-align: center;
            cursor: pointer;
            width: 150px;
        }

        .DC a{
            font-weight: bold;
            color: #fff;
        }

        button{
            background-color: #007BFF;
            width : 400px;
            height: 50px;
            border-radius: 10px;
            cursor: pointer;
        }


        /* Styles for the sidebar links */
        .sidebar {
            width: 400px;
            height:100%;
            background-color: #007BFF;
            color: #fff;
            padding: 10px;
            position: fixed;
            top: 130px;
            bottom: 60px; 
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        }

        .sidebar a {
            display: block;
            margin: 10px 0;
            text-decoration: none;
            color: #fff;
            margin-left: 20px;
            font-weight: bold;
            text-transform: uppercase;
            text-decoration: none;
            font-style: italic;
        }
        .sidebar .TDB{
            text-align:center;
            text-transform: uppercase;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;
        }
        .sidebar strong{
            text-transform: uppercase;
        }

        .search-bar {
            top: 130px;
            right: 20px; /* Ajustez la valeur pour déplacer la barre de recherche à droite */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            margin-left: 200px;
        }

        .search-bar input[type="text"] {
            width: 400px; 
            height:50px;
            padding: 10px;
            font-size: 18px;
            border-radius: 10px;
            margin-left: 100px;
        }

        .search-bar button {
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            width: 140px; 
            height:70px;
            cursor: pointer;
            border: none;
            font-size: 18px;
            border-radius: 10px;
            margin-left: 30px;

        }
       
    </style>
</head>
<body>

<div class="navbar">
        <h1 class="m-0 text-uppercase text-primary"><i class="fa fa-clinic-medical me-2"></i>&nbsp SAFRAM</h1>

        
        
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

        <div class="sidebar"><br>
        
            <h3><i class="icon">👨‍⚕️&nbsp</i>Bienvenue, &nbsp <strong>{{ Auth::user()->name }}</strong></h3><br>
            <h2 class="TDB"><i class="bi bi-list"></i> &nbsp Tableau de Bord Patient</h2><br>
            <a href="{{ route('patient.compte.profil') }}"><i class="bi bi-person-circle"></i> &nbsp Gérer mon compte</a><br><br>
            <a href="{{ route('patient.prendreRvd') }}"><i class="bi bi-calendar-plus"></i>&nbsp Prendre rendez-vous</a><br><br>

            <a href="{{ route('liste-medecins') }}"> <i class="fa fa-user-md"></i>&nbsp Liste des médecins</a><br><br>
            <a href="{{ route('patient.liste-dossiers-medicaux') }}"> <i class="fa fa-medkit"></i>&nbsp Mon dossier médical</a><br><br>
            <a href="{{ route('patient.historique-rendezvous') }}"><i class="bi bi-clock-history"></i>&nbsp Historique de mes Rendez-vous</a>
    </div>
 
    <!-- Barre de recherche à droite de l'espace non occupé -->
    <div class="search-bar">
        <form action="{{ route('patient.recherche-medecin') }}" method="GET">
            <input type="text" name="specialite" placeholder="Rechercher un médecin par spécialité">
            <button type="submit"><i class="bi bi-search"></i></button>
        </form>
    </div>

</body>
</html>
