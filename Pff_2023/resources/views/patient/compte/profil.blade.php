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
            background-color: ;
            width : 150px;
            height: 40px;
            border-radius: 10px;
            cursor: pointer;
            margin-left : 260px;
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
            margin-left : 340px;
        }

        .rendezvous-item {
            border: 5px solid #007BFF;
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 20px; 
            width: 700px; 
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
            text-transform: uppercase;
            font-size: 1.1em;
            font-style: italic;
            color: #007BFF;
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

    <br><br><br><br><br><br><br>
    <p>Bonjour Mr/Mme <strong>{{ Auth::user()->name }}</strong></p>

    @if (!$userHasInfo) <!-- Ajoutez cette condition -->
    <div class="rendezvous-container">
        <div class="rendezvous-item">
        <p class="bv"> Veillez s'il vous plaît renseigner vos informations dans le formulaire ci-dessous </p><br>

        <form method="POST" action="{{ route('patient.storeInfo') }}">
        @csrf
        <input type="text" name="nom" id="nom" placeholder="Rappeler votre Nom" required><br><br>
        
        <input type="text" name="prenom" id="prenom" placeholder="Rappeler votre Prenom" required><br><br>

        <input type="date" name="date_de_naissance" id="date_de_naissance" required><br><br>
        
        <select name="sexe" id="sexe" required>
            <option value="Homme">Homme</option>
            <option value="Femme">Femme</option>
        </select><br><br>

        <input type="text" name="adresse" id="adresse" placeholder="Votre adresse domicile" required><br><br>
        
        <input type="tel" name="numero_telephone" id="numero_telephone" placeholder="Votre numéro téléphone" required><br><br>
        
        <input type="text" name="contacts_urgence" id="contacts_urgence" placeholder="Contact en cas d'urgence" required><br><br><br>
        
        &nbsp &nbsp &nbsp<button class="BM" type="submit">Enregistrer</button>
    </form>
    </div>
    </div>
    @else
    <br><p class="in">Vos informations sont déjà enregistrées. Vous pouvez les voir <a href="{{ route('patient.info') }}">ici</a>.</p>
    @endif

</body>
</html>
