<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Médecins</title>
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
            margin-left: 900px;
            border-radius: 10px;
            border: 4px double #fff;
            text-align: center;
            cursor: pointer;
            color: #fff;

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
            width : 100px;
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
            margin-left : 200px;
            width : 100px;
            height: 40px;
            border-radius: 10px;
            cursor: pointer;
            color: #fff;
            font-weight: bold;
            font-style: italic;
            text-transform: uppercase;
        }
        .BM a{
            cursor: pointer;
            color: #fff;
            font-weight: bold;
            font-style: italic;
            text-transform: uppercase;
        }

        .p{
            margin-left : 110px;
        }

        .BS{
            background-color: red;
            width : 50px;
            height: 30px;
            border-radius: 10px;
            cursor: pointer;
        }
        .BS a{
            color: #fff;
            font-weight: bold;
            font-style: italic;
            text-transform: uppercase;
        }

        h2{
            color: #007BFF;
            font-weight: bold;
            font-size: 2em;
            font-style: italic;
            text-transform: uppercase;
            text-align:center;
        }
        a{
            text-decoration: none;
            color: #007BFF;
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

        .accueil{
            margin-left : 750px;
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            font-style: italic;
            text-transform: uppercase;
        }

        .bv{
            text-align: center;
        }

        .in{
            text-align: center;
            font-size: 1.2em;
        }
        
        .rendezvous-container {
            display: flex;
            flex-direction: row; 
            flex-wrap: wrap; 
            justify-content: flex-start; 
            align-items: flex-start; 
            gap: 20px; 
            margin-left : 500px;
        }

        .rendezvous-item {
            border: 5px solid #007BFF;
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 20px; 
            width: 500px; 
        }

        .rendezvous-item strong {
            font-weight: bold;
            color: #007BFF;
        }

        input, select{
            margin-left : 230px;
            width: 250px;
            height: 30px;
            border: 1px solid #007BFF;
            border-radius: 10px;
        }

        strong{
            margin-left : 120px;
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

    <br><br><br><br><br><br><br><br><br>

    <div class="rendezvous-container">
        <div class="rendezvous-item">
        <h2>Informations du patient</h2>

        @if (isset($patient))
            <p><strong>Nom :</strong> {{ $patient->nom }}</p>
            <p><strong>Prénom :</strong> {{ $patient->prenom }}</p>
            <p><strong>Date de naissance :</strong> {{ $patient->date_de_naissance }}</p>
            <p><strong>Sexe :</strong> {{ $patient->sexe }}</p>
            <p><strong>Adresse :</strong> {{ $patient->adresse }}</p>
            <p><strong>Numéro de téléphone :</strong> {{ $patient->numero_telephone }}</p>
            <p><strong>Contacts en cas d'urgence :</strong> {{ $patient->contacts_urgence }}</p><br>
            <button class="BM"><a href="{{ route('patient.edit') }}"><i class="fas fa-pencil-alt"></i></a></button>

        @else
            <p>Aucune information disponible.</p>
        @endif
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2023 &nbsp <i class="fa fa-clinic-medical me-2"></i>&nbsp SAFRAM. Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html>