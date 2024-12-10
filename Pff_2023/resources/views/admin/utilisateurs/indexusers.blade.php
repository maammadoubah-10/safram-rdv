<!-- resources/views/admin/list-users.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Utilisateurs</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">    

    <style>
        h2{
            color: #007BFF;
            font-weight: bold;
            font-size: 2em;
            font-style: italic;
            text-transform: uppercase;
            text-align: center;
        }
        table{
            color: #007BFF;
            margin-left: 330px;
        }

        input{
            width: 200px;
            height: 40px;
            border-radius: 10px;
            border: 2px solid #007BFF;
        }
        button{
            background-color: #007BFF;
            color: #fff;
            width : 100px;
            height: 40px;
            border-radius: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <div class="container mt-4">
        <h2>Liste des Utilisateurs</h2>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.search') }}" method="GET" class="mb-3">
            <div class="form">
                <input type="text" name="search" placeholder="Rechercher par nom">
                <button type="submit"><i class="bi bi-search"></i></button>
            </div>
            
        </form>
        <table class="">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->blocked)
                                <a href="{{ route('admin.unblock', $user) }}" class="btn btn-success">Débloquer</a>
                            @else
                                <a href="{{ route('admin.block', $user) }}" class="btn btn-warning">Bloquer</a>
                            @endif
                            
                        </td>
                    </tr>
                @endforeach+
            </tbody>
        </table>
    </div>

    <!-- Include Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


</body>
</html>