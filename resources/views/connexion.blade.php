<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Accueil</title>
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.2.2/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <!-- Custom asset -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script defer src="{{asset('js/main.js')}}"></script>
</head>
<body class="antialiased">
    <section>

        <div style="
            display: flex;
        ">
            <div style="
                width: 100vw;
                height: 100vh;
                background: rgb(131, 84, 84);
                background-image: url('{{asset('img/fond.jpg')}}');
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: cover;
            ">
                <div style="width: 100%; height: 100%; display: flex; align-items: center; jsutify-content: center;">
                    <div style="width: 100%; height: 100%; display: flex;">
                        <div style="
                            width: 100%;
                            height: 100%;
                            background: rgba(255, 255, 255, 0.4);
                            display: flex;
                            align-items: center;
                            justify-content: center;
                        ">
                            <div style="
                                width: 30%;
                                height: 60%;
                                background: rgba(0, 0, 0, 0.562);
                                border-radius: 2rem;
                                display: flex;
                                flex-direction: column;
                                align-items: center;
                                justify-content: center;
                            ">
                                <div style="
                                    width: 100%;
                                    height: 20%;
                                    font-size: 1.5rem;
                                    border-radius: 2rem;
                                    color: white;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                ">Connexion</div>

                                <div>
                                    <form action="/creer-connexion" method="post">
                                        @csrf
                    
                                        <div style="
                                            width: 100%;
                                            padding: 16px;
                                            border-radius: 16px;
                                        ">
                                            <div class="col-md-16" style="color: white;">
                                                <label for="username">Nom d'utilisateur</label>
                                                <input type="username" class="form-control" id="username" name="username" placeholder="Nom d'utilisateur" required>
                                            </div>
                                            <div class="col-md-16" style="color: white;margin-top: 1rem;">
                                                <label for="mdp">Mot de passe</label>
                                                <input type="password" class="form-control" id="mdp" name="mdp" placeholder="Mot de passe" required>
                                            </div>
                                            <div class="col-md-16" style="color: white;margin-top: 1rem;">
                                                @if (count($errors) > 0)
                                                    <div class="text-danger">
                                                        Vos informations d’identification sont incorrectes
                                                    </div>
                                                @endif
                                            </div>
                    
                                            <div style="
                                                width: 100%;
                                                margin-top: 2rem;
                                                display: flex;
                                                align-items: center;
                                                justify-content: center;
                                            ">
                                                <button type="submit" class="btn btn-primary">Se connecter</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>