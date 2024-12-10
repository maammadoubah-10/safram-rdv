<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    width: 400px;
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


.input {
    border: 2px solid #007BFF;
        width : 300px;
        height: 30px;
        border-radius: 10px;
        cursor: pointer;
        margin-left: 5px;
}

.button {
    color: #fff;
    font-weight: bold;
    text-transform: uppercase;
    background-color: #007BFF;
    width : 100px;
    height: 30px;
    border-radius: 10px;
    cursor: pointer;
    margin-left: 110px;
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
        text-decoration: none;
    }

    /* Style pour les erreurs de validation */
    .invalid-feedback {
        color: #dc3545;
    }

    h1, h4{
        color: #007BFF;
        margin-left: 50px;
    }
    </style>
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    
<div class="container">
    <div class="">
        <div class="">
            <div class="card">
                
                <div class="form">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <h1><i class="fa fa-clinic-medical me-2"></i>&nbsp SAFRAM</h1>
                        <h4>Connectez-vous à votre compte</h4><br>
                        <div>
                            <div> <!-- Utilisation de col-md-8 pour doubler la largeur -->
                                <input class="input" id="email" type="email" placeholder="Votre E-mail" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div><br>
                        
                        <div>
                            <div> <!-- Utilisation de col-md-8 pour doubler la largeur -->
                                <input class="input" id="password" type="password" placeholder="Votre Password" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div><br>
                        
                        <div>
                            <div >
                                <div>
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label style="color:#007BFF" class="form-check-label" for="remember">
                                        {{ __('Se souvenir de moi') }}
                                        &nbsp &nbsp &nbsp &nbsp 
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Mot de Passe oublié?') }}
                                            </a>
                                        @endif
                                    </label>
                                </div>
                            </div>
                        </div><br>
                        
                        <div>
                            <div>
                                <button class="button" type="submit">
                                    {{ __('Login') }}
                                </button><br><br>  
                            </div>
                        </div><br>

                        <label style="color:#007BFF; margin-left: 30px;">vous n'avez pas de compte ? &nbsp<a href="{{ route('register')}}" style="color:#007BFF">S'inscrire</a></label>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>
