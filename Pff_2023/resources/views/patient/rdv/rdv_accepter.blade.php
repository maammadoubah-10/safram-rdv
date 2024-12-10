<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes rendez-vous acceptés</title>
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
        .navbar .message .sms{
            margin-left: 100px;
            border-radius: 10px;
            width : 150px;
            border: 4px double #fff;
            text-align: center;
            cursor: pointer;

        }

        button{
            background-color: #007BFF;
            width : 400px;
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

        .accueil{
            margin-left : 800px;
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            font-size: 2em;
            font-style: italic;
            text-transform: uppercase;
        }

        .rendezvous-container {
            display: flex;
            flex-direction: row; /* Alignement de gauche à droite */
            flex-wrap: wrap; /* Passage à la ligne en cas de dépassement de la largeur */
            justify-content: flex-start; /* Début de la ligne */
            align-items: flex-start; /* Alignement du haut vers le bas */
            gap: 20px; /* Espace entre les rendez-vous */
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
        }


        

    </style>
</head>
<body>

    <div class="navbar">
            <h1 class="m-0 text-uppercase text-primary"><i class="fa fa-clinic-medical me-2"></i>&nbsp SAFRAM</h1>

            <div>
                <a href="accueilPatient" class="accueil"><i class="bi bi-house"></i> &nbsp Accueil</a>
            </div>
            <div class="message">
                <a href="{{ route('messages.index') }}"><button class="sms"><i class="bi bi-envelope"></i> &nbsp Messagerie</button></a>
            </div>
        </div>
        <br><br><br><br><br><br><br><br><br>

    <h2>Rendez-vous acceptés :</h2>
        <div class="rendezvous-container">
            @foreach ($rendezVousAcceptes as $rendezVous)
                <div class="rendezvous-item">
                    <strong>Date :</strong> {{ $rendezVous->date }}<br>
                    <strong>Heure de début :</strong> {{ $rendezVous->heure_debut }}<br>
                    <strong>Heure de fin :</strong> {{ $rendezVous->heure_fin }}<br>
                    <strong>Description :</strong> {{ $rendezVous->description }}<br>
                    <strong>Statut :</strong> {{ $rendezVous->statut }}<br>
                    <!-- Ajoutez d'autres informations si nécessaire -->
                </div>
            @endforeach
        </div>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2023 &nbsp <i class="fa fa-clinic-medical me-2"></i>&nbsp SAFRAM. Tous droits réservés.</p>
        </div>
    </footer>
</body>
</html>
