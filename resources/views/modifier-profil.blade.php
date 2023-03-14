<?php 
    use App\Models\Agent;
    use App\Models\Service;
    use App\Models\Fonction;

    $service = Service::all()->sortBy('id');

    $fonction = Fonction::all()->sortBy('id');

    $id_conneted = $_SESSION['id'];

    $agentConnected = Agent::find($id_conneted);

    $nom_connecte = $agentConnected->nom;
    $prenom_connecte = $agentConnected->prenom;
    $tel_connecte = $agentConnected->tel;
    $fonction_connecte = intval($agentConnected->id_fonction);
    $service_connecte = intval($agentConnected->id_service);
    $adresse_connecte = $agentConnected->adresse;
    $email_connecte = $agentConnected->email;
    $username_connecte = $agentConnected->username;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Modifier mon profil</title>
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
            {{-- SLIDER --}}
                <x-comp-slider />
            {{-- FIN SLIDER --}}

            <div style="
                width: 95vw;
                height: 100vh;
                background: rgb(131, 84, 84);
                background-image: url('{{asset('img/fond.jpg')}}');
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: cover;
            ">
                {{-- HEADER--}}
                <x-comp-header />
                {{-- FIN HEADER --}}

                <div style="width: 100%; height: 92vh; display: flex; align-items: center; jsutify-content: center;">
                    <div style="width: 100%; height: 92vh; display: flex;">
                        <div style="
                            width: 95%;
                            height: 100%;
                            background: rgba(255, 255, 255, 0.4);
                        ">
                            <div style="
                                height: 100%;
                                padding-left: 2%;
                                padding-top: 2%;
                            ">
                                {{-- NAV BAR --}}
                                <x-comp-nav-bar />
                                {{-- END NAV BAR --}}

                                <div style="height: 2%;"></div>
                                <div style="
                                    width: 100%;
                                    height: 90%;
                                ">
                                    <div style="
                                        height: 100%;
                                        border-top: solid 1px #EC9628;
                                    ">
                                        <div style="
                                            width: 100%;
                                            height: 10%;
                                            background: white;
                                            padding-left: 1rem;
                                            font-size: 1.1rem;
                                            font-weight: bold;
                                            display: flex;
                                            align-items: center;
                                            border-bottom: solid 3px gray;
                                        ">
                                            Mon dossier personnel&nbsp;<span style="color: #EC9628;"> / MODIFIER MON PROFIL</span>
                                        </div>

                                        <div style="
                                            width: 100%;
                                            height: 90%;
                                            background: rgb(216, 216, 216);
                                        ">
                                            <div style="
                                                height: 100%;
                                                display: flex;
                                            ">
                                                <div style="
                                                    width: 20%;
                                                    height: 100%;
                                                    background: white;
                                                    overflow-y: hidden;
                                                    overflow-x: hidden;
                                                ">
                                                    <div style="width: 100%;height: 100%;">
                                                        <a href="?action=1" style="
                                                            width: 100%;
                                                            height: 15%;
                                                            display: flex;
                                                            align-items: center;
                                                            padding-left: 0.5rem;
                                                            font-weight: 600;
                                                            cursor: pointer;
                                                            border-bottom: solid 2px rgba(128, 128, 128, 0.5);
                                                            <?php
                                                            $route = Route::current()->uri;
                                                            if (isset($_GET['action']) && !empty($_GET['action'])) {
                                                                if (intval($_GET['action']) === 1) {
                                                            ?>
                                                            background: silver;
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        ">
                                                            <div>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                                </svg>
                                                                Modifier mes informations personnelles
                                                            </div>
                                                        </a>

                                                        <a href="?action=2" style="
                                                            width: 100%;
                                                            height: 15%;
                                                            display: flex;
                                                            align-items: center;
                                                            padding-left: 0.5rem;
                                                            font-weight: 600;
                                                            cursor: pointer;
                                                            border-bottom: solid 2px rgba(128, 128, 128, 0.5);
                                                            <?php
                                                            $route = Route::current()->uri;
                                                            if (isset($_GET['action']) && !empty($_GET['action'])) {
                                                                if (intval($_GET['action']) === 2) {
                                                            ?>
                                                            background: silver;
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        ">
                                                            <div>
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
                                                                    <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z"/>
                                                                    <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                                                                </svg>
                                                                Modifier mes informations de connexion
                                                            </div>
                                                        </a>

                                                        <div style="padding: 1rem;"></div>
                                                    </div>
                                                </div>

                                                <div style="
                                                    width: 80%;
                                                    height: 100%;
                                                    background: rgb(216, 216, 216);
                                                ">
                                                    @if (isset($_GET['action']) && !empty($_GET['action']))
                                                        @if (intval($_GET['action'] )=== 1)
                                                            <form action="{{action('\App\Http\Controllers\AgentController@update')}}" method="POST" id="form-1" style="width: 100%;height: 100%;">
                                                                {{ csrf_field() }}
                                                                <input type="hidden" name="form" value="1">
                                                                <div style="
                                                                    width: 100%;
                                                                    height: 15%;
                                                                    display: flex;
                                                                    align-items: center;
                                                                ">
                                                                    <div style="
                                                                        width: 100%;
                                                                        height: 100%;
                                                                        display: flex;
                                                                        align-items: center;
                                                                        justify-content: space-between;
                                                                    ">
                                                                        <div class="" style="
                                                                            width: 50%;
                                                                            height: 80%;
                                                                            font-size: 1rem;
                                                                            font-weight: 600;
                                                                            padding-left: 0.5rem;
                                                                            padding-right: 0.5rem;
                                                                            display: flex;
                                                                            align-items: center;
                                                                        ">Modifier mes informations personnelles</div>
                                                                        <div style="
                                                                            padding-right: 0.5rem;
                                                                            width: 50%;
                                                                            height: 80%;
                                                                        ">
                                                                            <button id="faire-demande" class="btn btn-secondary" style="
                                                                                width: 100%;
                                                                                height: 80%;
                                                                                display: flex;
                                                                                align-items: center;
                                                                                justify-content: center;
                                                                            ">
                                                                                <div>
                                                                                    Enregistrer les modifications
                                                                                </div>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
        
                                                                <div style="
                                                                    width: 100%;
                                                                    height: 85%;
                                                                    background: white;
                                                                    overflow-y: scroll;
                                                                    overflow-x: hidden;
                                                                ">
                                                                    <div style="
                                                                        width: 100%;
                                                                    ">
                                                                        <div style="padding-top: 1rem;">
                                                                            <div style="padding-left: 2vw;">
                                                                                <div style="
                                                                                    width: 95%;
                                                                                    height: 35%;
                                                                                    border-radius: 41px;
                                                                                    padding: 24px;
                                                                                ">
                                                                                    <div class="form-row" style="width: 80%;margin-top:1rem;display: flex;flex-direction: row;">
                                                                                        <div class="col-md-4">
                                                                                            <label for="tel">Telephone</label>
                                                                                            <input type="tel" class="form-control" id="tel" name="tel" placeholder="Telephone" value="<?php echo $tel_connecte; ?>" required>
                                                                                        </div>
                                                                                    </div>
        
                                                                                    <div class="form-row" style="width: 80%;margin-top:1rem;display: flex;flex-direction: row;">
                                                                                        <div class="col-md-4">
                                                                                            <label for="adresse">Adresse</label>
                                                                                            <input type="name" class="form-control" id="nom" name="adresse" placeholder="adresse" value="<?php echo $adresse_connecte; ?>" required>
                                                                                        </div>
                                                                                        <div class="col-md-4" style="padding-left: 1rem;">
                                                                                            <label for="email">Email</label>
                                                                                            <input type="text" class="form-control" id="email" name="email" value="<?php echo $email_connecte; ?>" placeholder="Email" required>
                                                                                        </div>
                                                                                    </div>
        
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        @endif

                                                        @if (intval($_GET['action']) === 2)
                                                            <form action="{{action('\App\Http\Controllers\AgentController@update')}}" method="post" id="form-2" style="width: 100%;height: 100%;">
                                                                @csrf
                                                                <input type="hidden" name="form" value="2">
                                                                <div style="
                                                                    width: 100%;
                                                                    height: 15%;
                                                                    display: flex;
                                                                    align-items: center;
                                                                ">
                                                                    <div style="
                                                                        width: 100%;
                                                                        height: 100%;
                                                                        display: flex;
                                                                        align-items: center;
                                                                        justify-content: space-between;
                                                                    ">
                                                                        <div class="" style="
                                                                            width: 50%;
                                                                            height: 80%;
                                                                            font-size: 1rem;
                                                                            font-weight: 600;
                                                                            padding-left: 0.5rem;
                                                                            padding-right: 0.5rem;
                                                                            display: flex;
                                                                            align-items: center;
                                                                        ">Modifier mes informations de connexion</div>
                                                                        <div style="
                                                                            padding-right: 0.5rem;
                                                                            width: 50%;
                                                                            height: 80%;
                                                                        ">
                                                                            <button id="faire-demande" class="btn btn-secondary" style="
                                                                                width: 100%;
                                                                                height: 80%;
                                                                                display: flex;
                                                                                align-items: center;
                                                                                justify-content: center;
                                                                            ">
                                                                                <div>
                                                                                    Enregistrer les modifications
                                                                                </div>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
        
                                                                <div style="
                                                                    width: 100%;
                                                                    height: 85%;
                                                                    background: white;
                                                                    overflow-y: scroll;
                                                                    overflow-x: hidden;
                                                                ">
                                                                    <div style="
                                                                        width: 100%;
                                                                    ">
                                                                        <div style="padding-top: 1rem;">
                                                                            <div style="padding-left: 2vw;">
                                                                                <div style="
                                                                                    width: 95%;
                                                                                    height: 35%;
                                                                                    border-radius: 41px;
                                                                                    padding: 24px;
                                                                                ">
                                                                                    <div class="form-row" style="width: 80%;margin-top:1rem;display: flex;flex-direction: row;">
                                                                                        <div class="col-md-4">
                                                                                            <label for="username">Nom d'utilisateur</label>
                                                                                            <input type="username" class="form-control" id="username" name="username" placeholder="<?php echo $username_connecte; ?>" autocomplete="off">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-row" style="width: 80%;margin-top:1rem;display: flex;flex-direction: row;">
                                                                                        <div class="col-md-4">
                                                                                            <label for="current_mdp">Ancien Mot de passe</label>
                                                                                            <input type="password" class="form-control" id="current_mdp" name="current_mdp" placeholder="Mot de passe">
                                                                                        </div>
        
                                                                                        <div class="col-md-4" style="padding-left: 1rem;">
                                                                                            <label for="mdp">Nouveau mot de passe</label>
                                                                                            <input type="password" class="form-control" id="mdp" name="mdp" placeholder="Mot de passe">
                                                                                        </div>
        
                                                                                        <div class="col-md-4" style="padding-left: 1rem;">
                                                                                            <label for="mdp2">Confirmer le mot de passe</label>
                                                                                            <input type="password" class="form-control" id="mdp2" name="mdp2" placeholder="Confirmer le mot de passe">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- SLIDER RIGHT --}}
                        <?php
                            $retAdmins = Agent::find(intval($_SESSION['id']));
                            $retAdmins = $retAdmins->admins;

                            if ($retAdmins) {
                            ?>
                                <x-comp-slider-right />
                            <?php
                            }else {
                                ?>
                                    <div style="
                                        width:5%;
                                        height: 100%;
                                        background: rgba(255, 255, 255, 0.4);
                                        box-shadow: 0 4px 2px 3px rgba(0, 0, 0, 0.26);
                                    ">&nbsp;</div>
                                <?php
                            }
                        ?>
                        {{-- FIN SLIDER RIGHT --}}
                    </div>
                </div>
            </div>
        </div>

        @if (\Session::has('success'))
            <div class="alert alert-success" id="message" style="
                padding-left: 2vw;
                position: absolute;
                bottom: 0;
                right: 6rem;
            ">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" style="margin-left: 18px;margin-right: 20px" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                    <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z"/>
                    <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z"/>
                </svg>
                {{ \Session::get('success') }}
            </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger" id="message" style="
            padding-left: 2vw;
            position: absolute;
            bottom: 0;
            right: 6rem;
        ">
            <ul>
                @if ($errors->has('nom'))
                    @foreach ($errors->get('nom') as $message)
                        <li>Nom - {{ $message }}</li>
                    @endforeach
                @endif
                @if ($errors->has('prenom'))
                    @foreach ($errors->get('prenom') as $message)
                        <li>Prenom - {{ $message }}</li>
                    @endforeach
                @endif
                @if ($errors->has('tel'))
                    @foreach ($errors->get('tel') as $message)
                        <li>Téléphone - {{ $message }}</li>
                    @endforeach
                @endif
                @if ($errors->has('sexe'))
                    @foreach ($errors->get('sexe') as $message)
                        <li>Sexe - {{ $message }}</li>
                    @endforeach
                @endif
                @if ($errors->has('date_naissance'))
                    @foreach ($errors->get('date_naissance') as $message)
                        <li>Date de naissance - {{ $message }}</li>
                    @endforeach
                @endif
                @if ($errors->has('lieu_naissance'))
                    @foreach ($errors->get('lieu_naissance') as $message)
                        <li>Lieu de naissance - {{ $message }}</li>
                    @endforeach
                @endif
                @if ($errors->has('id_fonction'))
                    @foreach ($errors->get('id_fonction') as $message)
                        <li>Fonction - {{ $message }}</li>
                    @endforeach
                @endif
                @if ($errors->has('id_service'))
                    @foreach ($errors->get('id_service') as $message)
                        <li>Service - {{ $message }}</li>
                    @endforeach
                @endif
                @if ($errors->has('adresse'))
                    @foreach ($errors->get('adresse') as $message)
                        <li>Adresse - {{ $message }}</li>
                    @endforeach
                @endif
                @if ($errors->has('email'))
                    @foreach ($errors->get('email') as $message)
                        <li>Email - {{ $message }}</li>
                    @endforeach
                @endif
                @if ($errors->has('username'))
                    @foreach ($errors->get('username') as $message)
                        <li>Nom d'utilisateur - {{ $message }}</li>
                    @endforeach
                @endif
                @if (count($errors) > 0)
                    @foreach ($errors->all() as $error)
                        @if (intval($error) === 1)
                            <li>Le mot de passe actuel ne correspond pas.</li>
                        @endif
                    @endforeach
                @endif
                @if ($errors->has('mdp'))
                    @foreach ($errors->get('mdp') as $message)
                        <li>Mot de passe - {{ $message }}</li>
                    @endforeach
                @endif
                @if ($errors->has('admins'))
                    @foreach ($errors->get('admins') as $message)
                        <li>Administrateur - {{ $message }}</li>
                    @endforeach
                @endif
            </ul>
        </div>
    @endif

    </section>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>