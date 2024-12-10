<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            background-color: green;
            width : 50px;
            height: 30px;
            border-radius: 10px;
            cursor: pointer;
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

        .table{

            margin-left : 100px;
        }
        .corps{
            margin-left : 200px;
            margin-right : 200px;
        }
        .pagination{
            margin-left : 250px;
            background-color:grey;
            color:black;
            width: 300px;
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

    <h2>Statistiques des rendez-vous</h2><br>
    <div class="corps">

        <canvas id="myChart" width="300" height="100"></canvas>

    </div>

    <script>
        var data = @json($data);

        var ctx = document.getElementById('myChart').getContext('2d');

        var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['confirmé', 'Refusés', 'En attente'],
            datasets: [{
                label: 'Nombre de rendez-vous',
                data: [data.confirmé, data.refusés, data.en_attente],
                backgroundColor: [
                    'rgba(0, 255, 0, 0.2)',  // Vert pour confirmé
                    'rgba(255, 0, 0, 0.2)',  // Rouge pour refusé
                    'rgba(0, 0, 255, 0.2)',  // Bleu pour en attente
                ],
                borderColor: [
                    'rgba(0, 255, 0, 1)',  // Couleur du bord vert pour confirmé
                    'rgba(255, 0, 0, 1)',  // Couleur du bord rouge pour refusé
                    'rgba(0, 0, 255, 1)',  // Couleur du bord bleu pour en attente
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false, // Masquer la légende
                },
                title: {
                    display: true,
                    text: 'Diagramme de Barre des rendez-vous au cours de l\'année ' + (new Date()).getFullYear(),
                    position: 'bottom', // Positionnez le titre en bas du graphique
                    padding: {
                        top: 40 // Ajustez cette valeur pour déplacer le titre vers le bas
                    }
                },
            },
        }
    });


    </script>

    
    <footer class="footer">
        <div class="container">
            <p>&copy; 2023 &nbsp <i class="fa fa-clinic-medical me-2"></i>&nbsp SAFRAM. Tous droits réservés.</p>
        </div>
    </footer>

</body>
</html>
