<?php 
    use App\Models\Agent;
    use App\Models\Service;
    use App\Models\Fonction;

    $service = Service::all()->sortBy('id');

    $fonction = Fonction::all()->sortBy('id');

    $agents = Agent::all()->take(5)->sortBy('id');
    $countAgents = count($agents);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajouter un agents</title>
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
                                <div style="
                                    width: 100%;
                                    height: 8%;
                                    padding-left: 1rem;
                                    display: flex;
                                    align-items: center;
                                    background: white;
                                    border-bottom: solid 2px #EC9628;
                                ">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-justify-left" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M2 12.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                                          </svg>
                                        Ajouter un employé
                                    </div>
                                </div>
                                <div style="height: 2%;"></div>
                                <div style="
                                    width: 100%;
                                    height: 90%;
                                ">
                                    <div style="
                                        width: 100%;
                                        height: 100%;
                                        background: white;
                                        border-top: solid 1px #EC9628;
                                        overflow-y: scroll;
                                        overflow-x: hidden;
                                    ">
                                        <form action="{{action('\App\Http\Controllers\AgentController@store')}}" method="post" autocomplete="off">
                                            @csrf
                                            <div style="padding-left: 2vw;">
                                                <div style="
                                                    width: 95%;
                                                    height: 35%;
                                                    background: #FFFFFF;
                                                    border-radius: 41px;
                                                    padding: 24px;
                                                ">
                                                    <div class="form-row" style="width: 80%;margin-top:1rem;display: flex;flex-direction: row;">
                                                        <div class="col-md-4">
                                                            <label for="nom">Nom <span style="color: red;">*</span> </label>
                                                            <input type="name" class="form-control" id="nom" name="nom" placeholder="nom" autocomplete="off" value="<?php if(isset($_SESSION['input_nom']) && !empty($_SESSION['input_nom'])) { echo $_SESSION['input_nom']; } ?>" required>
                                                            @if ($errors->any())
                                                                @foreach ($errors->get('nom') as $message)
                                                                    <div class="feedback text-danger">{{ $message }}</div>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="col-md-4" style="padding-left: 1rem;">
                                                            <label for="prenom">Prenom <span style="color: red;">*</span> </label>
                                                            <input type="name" class="form-control" id="prenom" name="prenom" placeholder="Prenom" autocomplete="off" value="<?php if(isset($_SESSION['input_prenom']) && !empty($_SESSION['input_prenom'])) { echo $_SESSION['input_prenom']; } ?>" required>
                                                            @if ($errors->any())
                                                                @foreach ($errors->get('prenom') as $message)
                                                                    <div class="feedback text-danger">{{ $message }}</div>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="col-md-4" style="padding-left: 1rem;">
                                                            <label for="tel">Telephone <span style="color: red;">*</span> </label>
                                                            <input type="tel" class="form-control" id="tel" name="tel" placeholder="Telephone" autocomplete="off" value="<?php if(isset($_SESSION['input_tel']) && !empty($_SESSION['input_tel'])) { echo $_SESSION['input_tel']; } ?>" required>
                                                            @if ($errors->any())
                                                                @foreach ($errors->get('tel') as $message)
                                                                    <div class="feedback text-danger">{{ $message }}</div>
                                                                @endforeach
                                                            @endif
                                                            @if ($errors->any())
                                                                @foreach ($errors->get('length') as $message)
                                                                    <div class="feedback text-danger">{{ $message }}</div>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-row" style="width: 80%;margin-top:1rem;display: flex;flex-direction: row;">
                                                        <div class="col-md-4">
                                                            <label for="sexe">Sexe <span style="color: red;">*</span> </label>
                                                            <div class="form-group">
                                                                <select class="form-select form-control" id="sexe" name="sexe" autocomplete="off" aria-label="Default select example" required>
                                                                    <?php
                                                                        if(isset($_SESSION['input_sexe']) && !empty($_SESSION['input_sexe'])){
                                                                            $input_sexe = intval($_SESSION['input_sexe']);
                                                                        }else{
                                                                            $input_sexe = 0;
                                                                        }

                                                                        if ($input_sexe === 0) {
                                                                            echo '<option selected value="0">M</option>';
                                                                            echo '<option value="1">F</option>';
                                                                        }else {
                                                                            echo '<option selected value="1">F</option>';
                                                                            echo '<option value="0">M</option>';
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            @if ($errors->any())
                                                                @foreach ($errors->get('sexe') as $message)
                                                                    <div class="feedback text-danger">{{ $message }}</div>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="col-md-4" style="padding-left: 1rem;">
                                                            <label for="date_naissance">Date de naissance <span style="color: red;">*</span> </label>
                                                            <input type="date" class="form-control" id="date_naissance" name="date_naissance" autocomplete="off" placeholder="Date de naissance" value="<?php if(isset($_SESSION['input_date_naissance']) && !empty($_SESSION['input_date_naissance'])) { echo $_SESSION['input_date_naissance']; } ?>" required>
                                                            @if ($errors->any())
                                                                @foreach ($errors->get('date_naissance') as $message)
                                                                    <div class="feedback text-danger">{{ $message }}</div>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="col-md-4" style="padding-left: 1rem;">
                                                            <label for="lieu_naissance">Lieu de naissance <span style="color: red;">*</span> </label>
                                                            <input type="text" class="form-control" id="lieu_naissance" name="lieu_naissance" autocomplete="off" placeholder="Lieu de Naissance" value="<?php if(isset($_SESSION['input_lieu_naissance']) && !empty($_SESSION['input_lieu_naissance'])) { echo $_SESSION['input_lieu_naissance']; } ?>" required>
                                                            @if ($errors->any())
                                                                @foreach ($errors->get('lieu_naissance') as $message)
                                                                    <div class="feedback text-danger">{{ $message }}</div>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                            
                                                    <div class="form-row" style="width: 80%;margin-top:1rem;display: flex;flex-direction: row;">
                                                        <div class="col-md-4">
                                                            <label for="id_fonction">Fonction <span style="color: red;">*</span></label>
                                                            <div class="form-group">
                                                                <select class="form-select form-control" id="id_fonction" autocomplete="off" name="id_fonction" aria-label="Default select" required>
                                                                    <?php
                                                                        if(isset($_SESSION['input_id_fonction']) && !empty($_SESSION['input_id_fonction'])){
                                                                            $input_fonction = intval($_SESSION['input_id_fonction']);
                                                                        }else{
                                                                            $input_fonction = 1;
                                                                        }

                                                                        foreach ($fonction as $key => $item) {
                                                                            if ($input_fonction === $item->id) {
                                                                                echo '<option value="'.$item->id.'">'.$item->nom.'</option>';
                                                                            }
                                                                        }
                                                                        foreach ($fonction as $key => $item) {
                                                                            if ($input_fonction !== $item->id) {
                                                                                echo '<option value="'.$item->id.'">'.$item->nom.'</option>';
                                                                            }
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            @if ($errors->any())
                                                                @foreach ($errors->get('id_fonction') as $message)
                                                                    <div class="feedback text-danger">{{ $message }}</div>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="col-md-4" style="padding-left: 1rem;">
                                                            <label for="id_service">Service <span style="color: red;">*</span></label>
                                                            <div class="form-group">
                                                                <select class="form-select form-control" id="id_service" autocomplete="off" name="id_service" aria-label="Default select" required>
                                                                    <?php
                                                                        if(isset($_SESSION['input_id_service']) && !empty($_SESSION['input_id_service'])){
                                                                            $input_service = intval($_SESSION['input_id_service']);
                                                                        }else{
                                                                            $input_service = 1;
                                                                        }

                                                                        foreach ($service as $key => $item) {
                                                                            if ($input_service === $item->id) {
                                                                                echo '<option value="'.$item->id.'">'.$item->libelle.'</option>';
                                                                            }
                                                                        }
                                                                        foreach ($service as $key => $item) {
                                                                            if ($input_service !== $item->id) {
                                                                                echo '<option value="'.$item->id.'">'.$item->libelle.'</option>';
                                                                            }
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            @if ($errors->any())
                                                                @foreach ($errors->get('id_service') as $message)
                                                                    <div class="feedback text-danger">{{ $message }}</div>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                            
                                                    <div class="form-row" style="width: 80%;margin-top:1rem;display: flex;flex-direction: row;">
                                                        <div class="col-md-4">
                                                            <label for="adresse">Adresse</label>
                                                            <input type="text" class="form-control" id="adresse" name="adresse" autocomplete="off" value="<?php if(isset($_SESSION['input_adresse']) && !empty($_SESSION['input_adresse'])) { echo $_SESSION['input_adresse']; } ?>" placeholder="Adresse">
                                                            @if ($errors->any())
                                                            @foreach ($errors->get('adresse') as $message)
                                                                <div class="feedback text-danger">{{ $message }}</div>
                                                            @endforeach
                                                        @endif
                                                        </div>
                                                        
                                                        <div class="col-md-4" style="padding-left: 1rem;">
                                                            <label for="email">Email <span style="color: red;">*</span></label>
                                                            <input type="text" class="form-control" id="email" name="email" autocomplete="off" value="<?php if(isset($_SESSION['input_email']) && !empty($_SESSION['input_email'])) { echo $_SESSION['input_email']; } ?>" placeholder="Email" required>
                                                            @if ($errors->any())
                                                                @foreach ($errors->get('email') as $message)
                                                                    <div class="feedback text-danger">{{ $message }}</div>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                            
                                                    <div class="form-row" style="width: 80%;margin-top:1rem;display: flex;flex-direction: row;">
                                                        <div class="col-md-4">
                                                            <label for="username">Nom d'utilisateur <span style="color: red;">*</span></label>
                                                            <input type="username" class="form-control" id="username" name="username" autocomplete="off" value="<?php if(isset($_SESSION['input_username']) && !empty($_SESSION['input_username'])) { echo $_SESSION['input_username']; } ?>" placeholder="Nom d'utilisateur" required>
                                                            @if ($errors->any())
                                                                @foreach ($errors->get('username') as $message)
                                                                    <div class="feedback text-danger">{{ $message }}</div>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="col-md-4" style="padding-left: 1rem;">
                                                            <label for="mdp">Mot de passe <span style="font-size: 0.8rem;color: gray;">(au moins 8 caractère)</span> <span style="color: red;">*</span></label>
                                                            <input type="password" class="form-control" id="mdp" name="mdp" autocomplete="off" placeholder="Mot de passe" required>
                                                            @if ($errors->any())
                                                                @foreach ($errors->get('mdp') as $message)
                                                                    <div class="feedback text-danger">{{ $message }}</div>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                        <div class="col-md-4" style="padding-left: 1rem;">
                                                            <label for="mdp2">Confirmer votre mot de passe <span style="color: red;">*</span></label>
                                                            <input type="password" class="form-control" id="mdp2" name="mdp2" autocomplete="off" placeholder="Confirmer votre mot de passe" required>
                                                        </div>
                                                        <div class="col-md-3" style="padding-left: 1rem;">
                                                            <label for="admins">Administrateur</label>
                                                            <div class="form-group">
                                                                <select class="form-select form-control" id="admins" autocomplete="off" name="admins" aria-label="Default select example" required>
                                                                    <?php
                                                                        if(isset($_SESSION['input_admins']) && !empty($_SESSION['input_admins'])){
                                                                            $input_admin = intval($_SESSION['input_admins']);
                                                                        }else{
                                                                            $input_admin = 0;
                                                                        }

                                                                        if ($input_admin === 0) {
                                                                            echo '<option selected value="0">Non</option>';
                                                                            echo '<option value="1">Oui</option>';
                                                                        }else {
                                                                            echo '<option selected value="1">Oui</option>';
                                                                            echo '<option value="0">Non</option>';
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            @if ($errors->any())
                                                                @foreach ($errors->get('admins') as $message)
                                                                    <div class="feedback text-danger">{{ $message }}</div>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div style="
                                                        padding-left: 2vw;
                                                        padding-top: 4rem;
                                                        height: 100%;
                                                    ">
                                                        <div style="
                                                            width: 95%;
                                                            height: 8%;
                                                            background: white;
                                                            border-radius: 10vw;
                                                        ">
                                                            <div style="
                                                                height: 100%;
                                                                display: flex;
                                                                align-items: center;
                                                                justify-content: space-between;
                                                                font-weight: bold;
                                                            ">
                                                                <button type="button" class="ml-4 btn btn-danger" data-toggle="tooltip" title="Annuler la demande de congé" onclick="window.location.href = '/'">Annuler</button>
                                                                <div>
                                                                    <button type="reset" class="btn btn-info" data-toggle="tooltip" title="Reinitialiser le formulaire de demande de congé">Reinitialiser</button>
                                                                    <button type="submit" class="btn btn-success" id="send-agent" style="margin-left: 1rem;" data-toggle="tooltip" title="Envoyer la demande de congé">Soumettre</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
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
    </section>
    
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>