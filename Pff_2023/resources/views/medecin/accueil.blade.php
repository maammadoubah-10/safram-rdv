<!DOCTYPE html>
<html>
<head>
    <title>Accueil Médecin</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body{
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
        .navbar .message button{
            margin-left: 1150px;
            border-radius: 10px;
            border: 4px double #cccccc;
            text-align: center;
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

        /* Styles for the calendar container */
        .calendar-container {
            margin-left: 470px; /* To leave space for the sidebar */
            margin-top: 140px; /* To clear the top of the sidebar */
            margin-bottom: 60px; /* To clear the bottom of the sidebar and footer */
            position: fixed;
            width: 850px;
        }

    </style>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth'
            });
            calendar.render();
        });
    </script>
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
    <h2 class="TDB"><i class="bi bi-list"></i> &nbsp Tableau de Bord  Médecin</h2><br>
        <a href="{{ route('medecin.compte.profil') }}"><i class="bi bi-person-circle"></i> &nbsp Gérer mon compte</a><br><br>
        <a href="{{ route('disponibilite.index') }}"><i class="bi bi-calendar"></i> &nbsp Gérer Mes disponibilités</a><br><br>
        <a href="{{ route('medecin.rendezvous-avenir') }}"><i class="far fa-calendar"></i> &nbsp Mes rendez-vous à venir</a><br><br>
        <a href="{{ route('medecin.mes_rendezvous', ['medecinId' => $medecinId]) }}"> <i class="bi bi-list"></i> &nbsp historique des rendez-vous</a><br><br>
        <a href="{{ route('medecin.dossiers-patients') }}"><i class="bi bi-file-earmark-medical"></i> &nbsp Dossiers médicaux des patients</a>
    </div>
    <div class="calendar-container">
        <div id='calendar'></div>
    </div>

    
</body>
</html>
