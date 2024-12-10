<!DOCTYPE html>
<html>
<head>
    <link rel="Website Icon" type="png" href="www.png">
    <title>Accueil Administrateur</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            background-image: url('https://images.app.goo.gl/4EPCVALVn61xDkT49');
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

        .navbar .message button {
            margin-left: 1150px;
            border-radius: 10px;
            border: 4px double #cccccc;
            text-align: center;
            cursor: pointer;
        }

        /* Styles for the sidebar links */
        .sidebar {
            width: 400px;
            height: 100%;
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

        .sidebar .TDB {
            text-align: center;
            text-transform: uppercase;
            box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;
        }

        .sidebar strong {
            text-transform: uppercase;
        }

        .corps {
            margin-left: 500px;
            margin-right: 100px;
            text-align: center;
            margin-bottom: 50px; /* Ajoutez une marge inférieure de 40px (ou ajustez selon vos besoins) */
        }

        .h2{
            color: #007BFF;
            font-weight: bold;
            font-size: 2em;
            font-style: italic;
            text-transform: uppercase;
            text-align: center;
        }

    </style>
</head>
<body>
    <div class="navbar">
        <h1 class="m-0 text-uppercase text-primary"><i class="fa fa-clinic-medical me-2"></i>&nbsp SAFRAM</h1>

        <div class="message">
            <a href="{{ route('messages.index') }}"><button><i class="bi bi-envelope"></i> &nbsp Messagerie</button></a>
        </div>
    </div>

    <div class="sidebar"><br>
        <h3><i class="icon">👨‍⚕️&nbsp</i>Bienvenue, &nbsp <strong>{{ Auth::user()->name }}</strong></h3><br>
        <h2 class="TDB"><i class="bi bi-list"></i> &nbsp Tableau de Bord Admin</h2><br>
        <a href="{{ route('admin.mon-compte') }}"><i class="bi bi-person-circle"></i> &nbsp Gérer mon compte</a><br>
        <a href="{{ route('admin.medecins.list') }}"><i class="fas fa-user-md"></i> &nbsp Gestion des Médecins</a><br>
        <a href="{{ route('admin.specialites.liste') }}"><i class="fas fa-stethoscope"></i> &nbsp Gestion des Spécialités</a><br>
        <a href="{{ route('admin.utilisateurs.indexusers') }}"><i class="fas fa-user-cog"></i> &nbsp Gestion des Comptes</a><br>
        <a href="#"><i class="fas fa-file-invoice-dollar"></i> &nbsp Système de facturation</a><br>
        <a href="{{ route('statistics') }}"><i class="fas fa-chart-bar"></i> &nbsp Statistique</a>
    </div>

    <br><br><br><br><br><br><br><br>

    <div class="corps">
        <h2 class="h2">Statistiques des rendez-vous</h2><br><br><br>
        <canvas id="myChart" width="250" height="100" data-data='@json($data)'></canvas>
    </div>
</body>
</html>

<script>
var canvas = document.getElementById('myChart');
var data = JSON.parse(canvas.getAttribute('data-data'));

var ctx = canvas.getContext('2d');

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
        }
    }
});
</script>
