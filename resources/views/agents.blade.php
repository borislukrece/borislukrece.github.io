<?php 
    use App\Models\Agent;
    use App\Models\Service;
    use App\Models\Fonction;
    use App\Models\Direction;
    use App\Models\Sous_direction;

    function valid_donnees($donnees){
        $donnees = trim($donnees);
        $donnees = stripslashes($donnees);
        $donnees = htmlspecialchars($donnees);

        return $donnees;
    }

    function firstLetterUpper($mot) {
        $firstLetter = strtoupper(substr($mot, 0, 1));
        $restLetters = strtolower(substr($mot, 1));

        return $firstLetter.''.$restLetters;
    }

    function breakPhrase($phrase) {
        $remplacer = array(" ");
        
        $recupPhrase = $phrase;
        
        $breakStrPhrase = trim(str_replace($remplacer, " ", $recupPhrase));

        $separateur = "#[ ]+#";
        $mots = preg_split($separateur, $breakStrPhrase);

        $nbrMots = count($mots);

        $return = "";

        for ($i=0; $i < $nbrMots; $i++) { 
            $word = firstLetterUpper($mots[$i]);
            $return = $return.' '.$word;
        }

        return $return;
    }

    if (isset($_GET['nom']) && !empty($_GET['nom'])) {
        $nom_search = trim(breakPhrase(valid_donnees($_GET['nom'])));

        $agents = Agent::where('nom', $nom_search)
            ->get()
            ->sortBy('nom');
    }
    if (isset($_GET['prenom']) && !empty($_GET['prenom'])) {
        $prenom_search = trim(breakPhrase(valid_donnees($_GET['prenom'])));

        $agents = Agent::where('prenom', $prenom_search)
            ->get()
            ->sortBy('nom');
    }

    if (isset($_GET['nom']) && !empty($_GET['nom']) && isset($_GET['prenom']) && !empty($_GET['prenom'])){
        $nom_search = trim(breakPhrase(valid_donnees($_GET['nom'])));
        $prenom_search = trim(breakPhrase(valid_donnees($_GET['prenom'])));

        $agents = Agent::where('nom', $nom_search)
            ->where('prenom', $prenom_search)
            ->get()
            ->sortBy('nom');
    }

    if (!isset($_GET['nom']) || !isset($_GET['prenom'])) {
        $agents = Agent::all()->sortBy('nom');
    }

    if (!isset($agents)) {
        $agents = Agent::all()->sortBy('nom');
    }
    $countAgents = count($agents);

    $service = Service::all()->sortBy('id');
    $fonction = Fonction::all()->sortBy('id');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste des agents</title>
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
                                    display: flex;
                                    align-items: center;
                                    background: white;
                                    border-bottom: solid 2px #EC9628;
                                ">
                                    <div style="
                                        width: 100%;
                                        height: 100%;
                                        display: flex;
                                        flex-direction: column;
                                        justify-content: center;
                                        font-weight: 600;
                                    ">
                                        <form method="GET" class="form-row" style="display: flex;justify-content: space-between;">
                                            <div style="display: flex;padding-left: 2rem;">
                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" id="nom_search" name="nom" placeholder="Nom">
                                                </div>
                                                <div class="col-md-6" style="margin-left: 1rem;">
                                                    <input type="text" class="form-control" id="prenom_search" name="prenom" placeholder="Prenom">
                                                </div>
                                                {{-- <div class="col-md-6" style="margin-left: 1rem;">
                                                    <div class="form-group">
                                                        <select class="form-select" id="admin_search" name="admins" aria-label="Default select">
                                                            <option selected value="2">Administrateur</option>
                                                            <option value="1">Oui</option>
                                                            <option value="0">Non</option>
                                                          </select>
                                                    </div>
                                                </div> --}}
                                            </div>

                                            <div style="display: flex;justify-content: center;padding-right: 2rem;">
                                                <button type="submit" id="search-btn" class="btn btn-primary">
                                                    Rechercher
                                                </button>
                                            </div>
                                        </form>
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
                                            Total(s)&nbsp;<span style="color: #EC9628;"> {{$countAgents}}</span>
                                        </div>
                                        <div style="
                                            width: 100%;
                                            height: 90%;
                                        ">
                                            <div style="
                                                width: 100%;
                                                height: 100%;
                                                display: flex;
                                            ">
                                                <div style="
                                                    width: 100%;
                                                    height: 100%;
                                                ">
                                                    <div style="
                                                        width: 100%;
                                                        height: 100%;
                                                        background: #FFFFFF;
                                                        padding: 24px;
                                                        overflow-x: hidden;
                                                        overflow-y: scroll;
                                                    ">
                                                        <div id="list-search">
                                                            <table class="table table-striped">
                                                                <thead class="thead-dark">
                                                                  <tr>
                                                                    <th scope="col">Nom</th>
                                                                    <th scope="col">Prenom</th>
                                                                    <th scope="col">Sexe</th>
                                                                    <th scope="col">Date de naissance</th>
                                                                    <th scope="col">Lieu de naissance</th>
                                                                    <th scope="col">Fonction</th>
                                                                    <th scope="col">Service</th>
                                                                    <th scope="col">Sous Direction</th>
                                                                    <th scope="col">Direction</th>
                                                                    <th scope="col">Telephone</th>
                                                                    <th scope="col">Adresse</th>
                                                                    <th scope="col">Nom d'utilisateur</th>
                                                                    <th scope="col">Administrateur</th>
                                                                  </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach ($agents as $item)
                                                                    <tr data-toggle="modal" data-whatever="{{ $item->id }}" data-target="#modalUpdate" style="cursor: pointer;">
                                                                        <th scope="row"><?php echo $item->nom; ?></th>
                                                                        <td><?php echo $item->prenom; ?></td>
                                                                        <td><?php echo (!$item->sexe) ? "M" : "F"; ?></td>
                                                                        <td><?php echo $item->date_naissance; ?></td>
                                                                        <td><?php echo $item->lieu_naissance; ?></td>
                                                                        <td><?php
                                                                            $searchFonction = Fonction::find($item->id_fonction);
                                                                            echo $searchFonction->nom;
                                                                        ?></td>
                                                                        <td><?php
                                                                            $searchService = Service::find($item->id_service);
                                                                            echo $searchService->libelle;
                                                                        ?></td>
                                                                        <td><?php
                                                                            $searchServiceSousDirection = Service::find($item->id_service);
                                                                            if (intval($searchServiceSousDirection->id_sous_direction) === 0) {
                                                                                echo '<span style="color: gray;">(Aucune sous direction)</span> Secrétariat';
                                                                            }else{
                                                                                $searchSous_direction = Sous_direction::find($searchServiceSousDirection->id_sous_direction);
                                                                                echo $searchSous_direction->libelle;
                                                                            }
                                                                        ?></td>
                                                                        <td><?php
                                                                            $searchServiceSousDirectionDirection = Service::find($item->id_service);
                                                                            if (intval($searchServiceSousDirection->id_sous_direction) === 0) {
                                                                                $searchDirection = Direction::find(1);
                                                                                echo $searchDirection->libelle;
                                                                            }else{
                                                                                $searchSous_directionDirection = Sous_direction::find($searchServiceSousDirection->id_sous_direction);
                                                                                $searchDirection = Direction::find($searchSous_directionDirection->id_direction);
                                                                                echo $searchDirection->libelle;
                                                                            }
                                                                        ?></td>
                                                                        <td><?php echo $item->tel; ?></td>
                                                                        <td><?php echo $item->adresse; ?></td>
                                                                        <td><?php echo $item->username; ?></td>
                                                                        <td><?php 
                                                                            if ($item->admins) {
                                                                              echo 'Oui';
                                                                            } else {
                                                                              echo 'Non';
                                                                            }
                                                                            ?></td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
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

    </section>

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

    <section class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-labelledby="ModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form autocomplete="off" class="modal-content" action="{{action('\App\Http\Controllers\AgentController@update')}}" method="POST">
                {{ csrf_field() }}
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLongTitle">Modifier les informations d'un employé</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                {{-- FORM UPDATE --}}
                <div id="form-data-preload"></div>
                {{-- END UPDATE --}}
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button> --}}
                    {{-- <a href="" id="rapport-individuel" target="_blank" class="btn btn-secondary">Rapport Individuel</a>
                    <a href="" id="delete"  class="btn btn-danger btn-delete">Supprimer cet employé</a>
                    <a href="" id="pointer" class="btn btn-primary">Pointer cet employé</a> --}}
                    <div class="dropdown" data-toggle="tooltip" title="Administrateur" style="
                        padding-right: 2vw;
                        display: flex;
                        align-items: center;
                    ">
                        <button  class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" style="margin-right: 6px" fill="currentColor" class="bi bi-menu-button-wide-fill" viewBox="0 0 16 16">
                                <path d="M1.5 0A1.5 1.5 0 0 0 0 1.5v2A1.5 1.5 0 0 0 1.5 5h13A1.5 1.5 0 0 0 16 3.5v-2A1.5 1.5 0 0 0 14.5 0h-13zm1 2h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1 0-1zm9.927.427A.25.25 0 0 1 12.604 2h.792a.25.25 0 0 1 .177.427l-.396.396a.25.25 0 0 1-.354 0l-.396-.396zM0 8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V8zm1 3v2a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2H1zm14-1V8a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v2h14zM2 8.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0 4a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                            </svg>
                            Action
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                            <a class="dropdown-item text-secondary" href="" id="rapport-individuel" target="_blank" data-toggle="tooltip" title="Rapport Individuel" style="
                                display: flex;
                                align-items: center;
                            ">Rapport Individuel</a>
                            <a class="dropdown-item text-info" href="" id="historique-pointages" target="_blank" data-toggle="tooltip" title="Historique de pointage cet employé" style="
                                display: flex;
                                align-items: center;
                            ">Historique de pointage cet employé</a>
                            <a class="dropdown-item text-primary" href="" id="pointer" data-toggle="tooltip" title="Pointer cet employé" style="
                                display: flex;
                                align-items: center;
                            ">Pointer cet employé</a>
                            <a class="dropdown-item text-danger btn-delete" href="" id="delete" data-toggle="tooltip" title="Supprimer cet employé" style="
                                display: flex;
                                align-items: center;
                            ">Supprimer cet employé</a>
                        </div>
                    </div>
                    <button type="submit" class="btn" style="background-color:#EC9628;">Enregitrer les modifications</button>
                </div>
            </form>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>