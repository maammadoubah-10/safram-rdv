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
            margin-left: 20px;
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
            margin-left : 150px;
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
        .DC a{
            color: #fff;
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

        .liste{

            margin-left : 100px;
        }
        .corps{
            margin-left : 150px;
        }
        .pagination{
            margin-left : 100px;
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

    <div class="corps">
        <h2>Liste de tout les Médecins</h2><br>

        <button class="button"><a href="{{ route('admin.medecin.add') }}" class="btn btn-primary"><i class="fas fa-plus"></i></a></button><br><br><br>

        <table class="table">
            <thead>
                <tr>
                    <th>Image  &nbsp &nbsp</th>
                    <th>Nom &nbsp &nbsp </th>
                    <th>Prénom &nbsp &nbsp </th>
                    <th>Adresse &nbsp &nbsp </th>
                    <th>Spécialité &nbsp &nbsp </th>
                    <th>Téléphone &nbsp &nbsp </th>
                    <th>Prix de visite &nbsp &nbsp </th>
                    <th>Lieu &nbsp &nbsp </th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($medecins as $medecin)
                    <tr>
                    <th>
                      @if ($medecin->image)
                     <img src="{{ asset('storage/' . $medecin->image) }}" class="rounded-image" alt="Image du médecin" height="20" width="20px">
                           @else
                    <span>Aucune image</span>
                      @endif
                    </th>
                        <td>{{ $medecin->name }} &nbsp &nbsp</td>
                        <td>{{ $medecin->lastName }} &nbsp &nbsp </td>
                        <td>{{ $medecin->adresse }} &nbsp &nbsp</td>
                        <td>{{ $medecin->specialite->nom }} &nbsp &nbsp</td>
                        <td>{{ $medecin->tel }} &nbsp &nbsp</td>
                        <td>{{ $medecin->prixVisite }} &nbsp &nbsp</td>
                        <td>{{ $medecin->lieu }} &nbsp &nbsp</td>
                        <td>
                            <button class="BM"><a href="{{ route('admin.medecin.edit', $medecin->id) }}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i></a> &nbsp</button>
                            <button class="BS"><a href="{{ route('admin.medecin.delete', $medecin->id) }}" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce médecin ?"><i class="fas fa-trash-alt"></i><br></a></button><br>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        <div class="pagination">
            {{ $medecins->links() }}
        </div>
    </div>
        
    <footer class="footer">
        <div class="container">
            <p>&copy; 2023 &nbsp <i class="fa fa-clinic-medical me-2"></i>&nbsp SAFRAM. Tous droits réservés.</p>
        </div>
    </footer>

</body>
</html>