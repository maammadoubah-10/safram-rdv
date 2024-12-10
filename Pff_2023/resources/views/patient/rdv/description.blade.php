<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">    

    <style>



        
        textarea{
            border: 2px solid #007BFF;
            width : 500px;
            height: 150px;
            border-radius: 10px;
            cursor: pointer;
            
        }



        



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
            margin-left: 200px;
            border-radius: 10px;
            border: 4px double #fff;
            text-align: center;
            cursor: pointer;
            color: #fff;
            font-weight: bold;
        }

        .button1{
            background-color: green;
            width : 150px;
            height: 50px;
            border-radius: 10px;
            cursor: pointer;
            margin-left: 100px;
        }
        .button2{
            background-color: red;
            width : 150px;
            height: 50px;
            border-radius: 10px;
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
            width : 300px;
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
            background-color: green;
            width : 50px;
            height: 30px;
            border-radius: 10px;
            cursor: pointer;
            margin-left: 230px;
        }
        .BM a{
            color: #fff;
            font-weight: bold;
            font-style: italic;
            text-transform: uppercase;
        }

        .BS{
            background-color: red;
            width : 50px;
            height: 30px;
            border-radius: 10px;
            cursor: pointer;
        }
        .BS{
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
            text-align: center;
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

        .accueil1{
            margin-left : 450px;
            width: 300px;
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            font-style: italic;
            text-transform: uppercase;
        }



        .submit{
            background-color: #fff;
            width : 50px;
            height: 30px;
            border-radius: 10px;
            cursor: pointer;
            border: 2px solid #007BFF;

        }
        .submit a{
            color: #fff;
            font-weight: bold;
            font-style: italic;
            text-transform: uppercase;
        }

        form input{
            width: 230px;
            height: 30px;
            border-radius: 10px;
            border: 2px solid #007BFF;

        }
        .corps{
            margin-left : 200px;
            margin-right : 200px;
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

        .p{
            margin-left:70px;
        }

        .sms{
            
            margin-top:100px;
            color: red;
            font-weight: bold;
            font-size: 1.3em;
            font-style: italic;
            text-align: center;
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
        .corps{
            margin-left: 500px;
        }

        .corps p{

            
            font-size: 1em;
            font-style: italic;

        }

        .modal p{
            margin-left: 80px;
        }

    </style>
</head>
<body>

<div class="navbar">
        <h1 class="m-0 text-uppercase text-primary"><i class="fa fa-clinic-medical me-2"></i>&nbsp SAFRAM</h1>
        
        <div class="accueil1">
            <form action="{{ route('patient.recherche-medecin') }}" method="GET">
                <input type="text" name="specialite" placeholder="Rechercher un médecin par spécialité">
                <button class="submit" type="submit"><i class="bi bi-search"></i></button>
            </form>
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
        <br><br><br><br><br>
    
        <div class="corps">
        <br><br><br>
        <div>
            <p>
                Le prix de visite de ce médecin est de {{ $medecin->prixVisite }} Francs + 1000 Francs<br>
                qui sont les frais de la réservation ce qui donne un total de {{ $medecin->prixVisite + 1000 }} Francs
            </p>
            <div class="payment-methods">
                Veillez sélectionner votre système de paiement &nbsp
                <select id="paymentMethod" name="paymentMethod">
                    <option value="Wave">Wave</option>
                    <option value="Orange_Money">Orange Money</option>
                    <option value="paypal">PayPal</option>
                    <option value="Carte_Bancaire">Carte Bancaire</option>
                </select>
            </div>
        </div><br>
        <form id="reservationForm" method="POST" action="{{ route('patient.rdv.enregistrer', ['medecinId' => $medecin->id, 'disponibiliteId' => $disponibilite->id]) }}">
            @csrf
            <input type="hidden" name="medecin_id" value="{{ $medecin->id }}">
            <input type="hidden" name="disponibilite_id" value="{{ $disponibilite->id }}">                            
            <textarea id="description" name="description" placeholder=" Veiller décrire votre état de santé actuel !" required autofocus></textarea><br><br>

            <!-- Add a function call to show confirmation modal -->
            <button type="button" class="BM" onclick="validateAndShowModal()"><i class="bi bi-check bi-3x"></i></button>

            <!-- Modal for confirmation -->
            <div id="confirmationModal" class="modal">
                <div class="modal">
                    <span class="close" onclick="hideConfirmationModal()">&times;</span>
                    <p>Êtes-vous sûr de vouloir réserver votre rendez-vous ?</p>
                    <!-- Add a function call to submit the form -->
                    <button class="button1" type="button" onclick="submitForm()">Oui</button>
                    <button class="button2" type="button" onclick="hideConfirmationModal()">Annuler</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Your existing HTML -->

    <script>
        // JavaScript functions for the confirmation modal
        function validateAndShowModal() {
            var description = document.getElementById('description').value.trim();

            if (description === '') {
                alert('Veuillez d\'abord décrire votre rendez-vous.');
            } else {
                showConfirmationModal();
            }
        }

        function showConfirmationModal() {
            var modal = document.getElementById('confirmationModal');
            modal.style.display = 'block';
        }

        function hideConfirmationModal() {
            var modal = document.getElementById('confirmationModal');
            modal.style.display = 'none';
        }

        function submitForm() {
            document.getElementById('reservationForm').submit();
        }
    </script>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2023 &nbsp <i class="fa fa-clinic-medical me-2"></i>&nbsp SAFRAM. Tous droits réservés.</p>
        </div>
    </footer>

</body>
</html>
