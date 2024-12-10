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
        }
        a{
            text-decoration: none;
            color: #007BFF;
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

        .liste{

            margin-left : 100px;
        }
        .table{
            margin-left : 100px;
        }
        
        .pagination{
            margin-left : 250px;
            color:#fff;
            width: 300px;
        }
        .rounded-image {
        border-radius: 50%;
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

<div class="liste">
    <h2>Liste de tous les Médecins</h2>
    <table class="table">
        <tbody>
        @foreach ($medecins as $medecin)
    <tr>
        <td>
            @if ($medecin->image)
                <img src="{{ asset('storage/' . $medecin->image) }}" alt="Image du médecin" class="rounded-image" height="20" width="20px">
            @else
                <span>Aucune image</span>
            @endif
            <a href=""> &nbsp {{ $medecin->name }} {{ $medecin->lastName }} </a><br><br>
        </td>
    </tr>
@endforeach
        </tbody>
    </table><br>
    <div>
        {{ $medecins->links() }}</button>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p>&copy; 2023 &nbsp <i class="fa fa-clinic-medical me-2"></i>&nbsp SAFRAM. Tous droits réservés.</p>
    </div>
</footer>

</body>
</html>