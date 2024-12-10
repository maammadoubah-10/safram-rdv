<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="img/favicon.ico" rel="icon">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link href="css/style.css" rel="stylesheet">
    <style>
.container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    width: 100%;
    position: relative;
    background-image: url('img/hopital.png'); /* Remplacez 'votre-image.jpg' par le chemin de votre image */
    background-size: cover;
    background-repeat: no-repeat;
    filter: brightness(50%); /* Filtre de luminosité sombre */
    color: #fff;
    
}


.card {
    width: 500px;
    border: 1px solid #ccc;
    border-radius: 10px;
    padding: 10px;
    background-color: rgba(255, 255, 255, 0.7); /* Couleur de fond claire avec opacité */
    backdrop-filter: blur(5px); /* Applique un flou au contenu (facultatif) */
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
}

    .card .form {
        filter: brightness(100%);
        margin-left: 45px;
    }


    input {
        border: 2px solid #007BFF;
        width : 300px;
        height: 30px;
        border-radius: 10px;
        cursor: pointer;
        margin-left: 100px;
    }

    select{
        border: 2px solid #007BFF;
        margin-left: 100px;
        width : 305px;
        height: 30px;
        border-radius: 10px;
        cursor: pointer;
    }

button {
    color: #fff;
    font-weight: bold;
    text-transform: uppercase;
    background-color: #007BFF;
    width : 100px;
    height: 30px;
    border-radius: 10px;
    cursor: pointer;
    margin-left: 190px;
}
    /* Style des étiquettes et des champs de saisie */
    .col-form-label {
        font-weight: bold;
    }

    /* Style des boutons */
    .btn-primary {
        background-color: #007bff;
        color: #fff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    /* Style des liens */
    .btn-link {
        color: #007bff;
        text-decoration: none;
    }

    .btn-link:hover {
        text-decoration: underline;
    }

    /* Style pour les erreurs de validation */
    .invalid-feedback {
        color: #dc3545;
    }

    h1, h4{
        color: #007BFF;
        text-align: center;
    }

    a{
            text-decoration: none;
        }
    </style>
</head>
<body>
    

<div class="container">

            <div class="card">
              
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <h1><i class="fa fa-clinic-medical me-2"></i>&nbsp SAFRAM</h1>
                        <h4>Inscrivez-vous </h4>
                        

                            <div>
                                <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="Entrer votre nom d'utilisateur" required autocomplete="name">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div><br>

                            <div>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Entrer votre adresse e-mail" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div><br>
                    
                            <div>
                                <select id="profil" name="profil" required>
                                    <option value="">Sélectionnez votre profil</option> <!-- Option par défaut -->
                                    <option value="Patient">Patient </option>
                                    <option value="Admin">Administrateur </option>
                                </select>
                                @error('profil')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div><br>

                            <div class="col-md-6">
                                <input id="password" type="password" name="password" placeholder="Entrer votre mot de passe" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div><br>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" name="password_confirmation" placeholder="Confirmer votre mot de passe" required autocomplete="new-password">
                            </div><br>

                                <button>
                                    {{ __('Register') }}
                                </button><br><br>

                                <label style="color:#007BFF; margin-left: 110px;">vous avez déja un compte ? &nbsp <a href="{{ route('login')}}" style="color:#007BFF"> Se connecter</a>


                    </form>
                </div>
            </div>
</body>
</html>