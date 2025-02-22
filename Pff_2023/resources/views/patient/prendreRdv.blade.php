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
            margin-left: 100px;
            border-radius: 10px;
            border: 4px double #fff;
            text-align: center;
            cursor: pointer;

        }

        form{
            margin-left: 100px;
        }

        h2{
            font-weight: bold;
            font-size: 1.5em;
            font-style: italic;
            text-transform: uppercase;
        }

        form input{
            width : 400px;
            height: 50px;
            border-radius: 10px;
        }

        button{
            background-color: #007BFF;
            width : 150px;
            height: 50px;
            border-radius: 10px;
            cursor: pointer;
        }

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
        
    </style>
</head>
<body>

    <div class="navbar">
        <h1 class="m-0 text-uppercase text-primary"><i class="fa fa-clinic-medical me-2"></i>&nbsp SAFRAM</h1>
        
        <div>
            <a href="patient/accueilPatient" class="accueil"><i class="bi bi-house"></i> &nbsp Accueil</a>
        </div>
        <div class="message">
            
            <a href="{{ route('messages.index') }}"><button>Messagerie</button></a>
        </div>

    </div>
<br><br><br><br><br><br><br><br><br>
    <div>
    <br><br><br><br>
        <form action="{{ route('patient.search-medecin') }}" method="GET">
                <h2>Rechercher un médecin par Nom ou Prénom : &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
                    <input type="text" name="search" id="search" placeholder="      Rechercher un médecin par nom ou prénom" required>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
                </h2>
            
        </form>
        <br><br><br><br>
        <form action="{{ route('patient.recherche-medecin') }}" method="GET">
            <h2> Rechercher un médecin par sa spécialité : &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
                <input type="text" name="specialite" placeholder="      Rechercher un médecin par spécialité" required>
                <button type="submit"><i class="bi bi-search"></i></button>
            </h2>
            
        </form>

    </div>
    
    <footer class="footer">
        <div class="container">
            <p>&copy; 2023 &nbsp <i class="fa fa-clinic-medical me-2"></i>&nbsp SAFRAM . Tous droits réservés.</p>
        </div>
    </footer>

</body>
</html>