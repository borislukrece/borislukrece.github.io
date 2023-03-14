<?php 
    use Ramsey\Uuid\Uuid;

    use App\Models\Agent;
    use App\Models\Pointage;
    use App\Models\CodeQr;

    function valid_donnees($donnees){
        $donnees = trim($donnees);
        $donnees = stripslashes($donnees);
        $donnees = htmlspecialchars($donnees);

        return $donnees;
    }

    date_default_timezone_set('UTC');
    $now = time();
    
    $date = date('Y-m-d', $now);
    $heure = date('H:i', $now);
?>
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
                                padding-top: 2%;
                            ">
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
                                            height: 100%;
                                            background: rgba(255, 255, 255, 0.819);
                                            border-bottom: solid 3px gray;
                                            border-right: solid 1px rgba(0, 0, 0, 0.123);
                                            display: flex;
                                        ">
                                            @if (!isset($_GET['agent']) || empty($_GET['agent']))
                                                <div style="
                                                    width: 20%;
                                                    height: 100%;
                                                    background: rgba(0, 0, 0, 0.73);
                                                    color: white;
                                                ">
                                                    <div style="width: 100%;height: 90%;">
                                                        <div style="text-align: center;padding-top: 1rem;">Agent sélectionné</div>
                                                        <div style="font-weight: bold;text-align: center;padding-top: 1rem;">AUCUN</div>
                                                    </div>
                                                    <div id="horloge" style="
                                                        width: 100%;
                                                        height: 10%;
                                                        display: flex;
                                                        flex-direction: column;
                                                        align-items: center;
                                                        justify-content: center;
                                                    "></div>
                                                </div>
                                            @endif

                                            <div style="
                                                width: 20%;
                                                height: 100%;
                                            ">
                                                @if (isset($_GET['agent']) && !empty($_GET['agent']))
                                                    <div style="
                                                        width: 100%;
                                                        height: 100%;
                                                        background: rgba(0, 0, 0, 0.73);
                                                        color: white;
                                                    ">
                                                        <div style="width: 100%;height: 90%;">
                                                            <?php 
                                                                $agent = Agent::find(valid_donnees($_GET['agent']));
                                                            ?>
                                                            <div style="text-align: center;padding-top: 1rem;">Agent sélectionné</div>

                                                            @if ($agent !== null)
                                                                <div style="font-weight: bold;text-align: center;padding-top: 1rem;">
                                                                <?php
                                                                    $myuuid = Uuid::uuid4();
                                                                    $path = '../public/qrcodes/'.$agent->id.'.svg';
                                                                    $filename = "/qrcodes/$agent->id.svg";

                                                                    $qr = CodeQr::where('id_user', $agent->id)->get();

                                                                    if (!count($qr)) {
                                                                        QrCode::size(200)->generate($myuuid, $path);
                                                                        CodeQr::create([
                                                                            "id_user" => $agent->id,
                                                                            "token" => $myuuid,
                                                                        ]);
                                                                    }else{
                                                                        if (!file_exists("../public$filename")) {
                                                                            $updateQr = CodeQr::where("id_user", $agent->id)->get();
                                                                            if(count($updateQr)){
                                                                                CodeQr::destroy($updateQr[0]->id);
                                                                                echo "<script> window.location.href = '/scan?agent=$agent->id';</script>";
                                                                            }
                                                                        }
                                                                    }

                                                                    echo strtoUpper($agent->nom).' '.strtoUpper($agent->prenom);
                                                                ?>
                                                                </div>

                                                                @if (file_exists("../public/$filename"))
                                                                    <div style="display: flex;align-items: center;justify-content: center;">
                                                                        <img src="{{$filename}}" alt="QR Code" style="width: 80%;height: auto;padding: 2rem;">
                                                                    </div>
                                                                @endif
                                                            @else
                                                                <div style="font-weight: bold;text-align: center;padding-top: 1rem;">
                                                                    AUCUN
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div id="horloge" style="
                                                            width: 100%;
                                                            height: 10%;
                                                            display: flex;
                                                            flex-direction: column;
                                                            align-items: center;
                                                            justify-content: center;
                                                        "></div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div style="
                                                width: 30%;
                                                height: 100%;
                                            ">
                                                @if (isset($_GET['agent']) && !empty($_GET['agent']) && $agent!==null)
                                                    <div id="option-scan" style="
                                                        width: 100%;
                                                        height: 100%;
                                                        background: rgba(192, 192, 192, 0.301);
                                                        border-right: solid 1px rgba(0, 0, 0, 0.123);
                                                    ">
                                                        <div style="
                                                            width: 100%;
                                                            height: 20%;
                                                            font-weight: bold;
                                                            display: flex;
                                                            align-items: center;
                                                            justify-content: center;
                                                        ">CHOISIR UNE OPTION</div>
                                                        <div style="
                                                            width: 100%;
                                                            height: 80%;
                                                            display: flex;
                                                            flex-direction: column;
                                                            align-items: center;
                                                            justify-content: center;
                                                        ">
                                                            <form action="{{action('\App\Http\Controllers\PostControllers@scan')}}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="agent" value="{{$agent->id}}">
                                                                <?php
                                                                    $verifExistence = Pointage::where('date_actuelle', $date);
                                                                    if ($verifExistence->exists()) {
                                                                        $verification = Pointage::where('date_actuelle', $date)->where('id_agent', $agent->id)->get()[0];
                                                                        if ($verification->heure_arrivee === null){
                                                                            $verif = false;
                                                                        }else{
                                                                            $verif = true;
                                                                        }
                                                                    } else {
                                                                        $verif = false;
                                                                    }
                                                                    
                                                                ?>
                                                                @if (!$verif)
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="pointage" value="arrivee" id="arrivee">
                                                                        <label class="form-check-label" for="arrivee">
                                                                            <div class="btn btn-lg" style="background: #317AC1;margin: 1rem;">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-door-open-fill" viewBox="0 0 16 16">
                                                                                    <path d="M1.5 15a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2.5A1.5 1.5 0 0 0 11.5 1H11V.5a.5.5 0 0 0-.57-.495l-7 1A.5.5 0 0 0 3 1.5V15H1.5zM11 2h.5a.5.5 0 0 1 .5.5V15h-1V2zm-2.5 8c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z"/>
                                                                                </svg>
                                                                                <div>Heure d'arrivée</div>
                                                                            </div>
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="pointage" value="depart" id="depart" disabled>
                                                                        <label class="form-check-label" for="depart">
                                                                            <div class="btn btn-lg" style="background: #317AC1;margin: 1rem;">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-door-closed-fill" viewBox="0 0 16 16">
                                                                                    <path d="M12 1a1 1 0 0 1 1 1v13h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V2a1 1 0 0 1 1-1h8zm-2 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                                                                </svg>
                                                                                <div>Heure de départ</div>
                                                                            </div>
                                                                        </label>
                                                                    </div>
                                                                @else
                                                                    <?php
                                                                        $pointage = Pointage::where('date_actuelle', $date)->where('id_agent', $agent->id)->get()[0];
                                                                    ?>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="pointage" value="arrivee" id="arrivee" disabled>
                                                                        <label class="form-check-label" for="arrivee">
                                                                            <div class="btn btn-lg" style="background: #317AC1;margin: 1rem;">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-door-open-fill" viewBox="0 0 16 16">
                                                                                    <path d="M1.5 15a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2.5A1.5 1.5 0 0 0 11.5 1H11V.5a.5.5 0 0 0-.57-.495l-7 1A.5.5 0 0 0 3 1.5V15H1.5zM11 2h.5a.5.5 0 0 1 .5.5V15h-1V2zm-2.5 8c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z"/>
                                                                                </svg>
                                                                                <div>Heure d'arrivée</div>
                                                                            </div>
                                                                            <span class="text-success">{{ $pointage->heure_arrivee }}</span>
                                                                        </label>
                                                                    </div>
                                                                    @if ($pointage->heure_depart === null || $pointage->heure_depart === 'null')
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" name="pointage" value="depart" id="depart">
                                                                            <label class="form-check-label" for="depart">
                                                                                <div class="btn btn-lg" style="background: #317AC1;margin: 1rem;">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-door-closed-fill" viewBox="0 0 16 16">
                                                                                        <path d="M12 1a1 1 0 0 1 1 1v13h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V2a1 1 0 0 1 1-1h8zm-2 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                                                                    </svg>
                                                                                    <div>Heure de départ</div>
                                                                                </div>
                                                                            </label>
                                                                        </div>
                                                                    @else
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="radio" name="pointage" value="depart" id="depart" disabled>
                                                                            <label class="form-check-label" for="depart">
                                                                                <div class="btn btn-lg" style="background: #317AC1;margin: 1rem;">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-door-closed-fill" viewBox="0 0 16 16">
                                                                                        <path d="M12 1a1 1 0 0 1 1 1v13h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V2a1 1 0 0 1 1-1h8zm-2 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                                                                    </svg>
                                                                                    <div>Heure de départ</div>
                                                                                </div>
                                                                                <span class="text-success">{{ $pointage->heure_depart }}</span>
                                                                            </label>
                                                                        </div>
                                                                    @endif
                                                                @endif

                                                                <div style="display: flex;align-items: center;justify-content: center;margin-top: 2rem;">
                                                                    <button class="btn btn-lg" style="background: #FFFFFF;font-weight: bold;color: rgb(0, 0, 0);">Pointer</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div style="
                                                width: 50%;
                                                height: 100%;
                                            ">
                                                @if (isset($_GET['agent']) && !empty($_GET['agent']) && $agent!==null)
                                                    <div style="
                                                        width: 100%;
                                                        height: 100%;
                                                        background: rgba(255, 255, 255, 0.137);
                                                    ">
                                                        @if (\Session::has('success'))
                                                        <?php
                                                            $value = Pointage::where('date_actuelle', $date)->where('id_agent', $agent->id)->get()[0];
                                                        ?>
                                                            <div class="scan-success" style="
                                                                width: 100%;
                                                                height: 100%;
                                                                display: flex;
                                                                flex-direction: column;
                                                                align-items: center;
                                                                justify-content: center;
                                                            ">
                                                                <div class="text-success" style="font-weight: bold;font-size: 1.1rem;margin: 2rem 0 2rem 0;">SUCESS</div>
                                                                <div style="
                                                                    width: 50%;
                                                                    height: 50%;
                                                                    background:#424242;
                                                                    border-radius: 10%;
                                                                    color: white;
                                                                    display: flex;
                                                                    justify-content: center;
                                                                ">
                                                                    <div>
                                                                        <div style="height: 10%;font-weight: bold;padding-top: 1rem;">
                                                                            {{ strtoUpper($agent->nom).' '.strtoUpper($agent->prenom) }}
                                                                        </div>
                                                                        <div style="height: 80%;display: flex;align-items:center;">
                                                                            <div>
                                                                                <div>
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-door-open-fill" viewBox="0 0 16 16">
                                                                                        <path d="M1.5 15a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2.5A1.5 1.5 0 0 0 11.5 1H11V.5a.5.5 0 0 0-.57-.495l-7 1A.5.5 0 0 0 3 1.5V15H1.5zM11 2h.5a.5.5 0 0 1 .5.5V15h-1V2zm-2.5 8c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z"/>
                                                                                    </svg>
                                                                                    Heure d'arrivée
                                                                                    <span class="text-success">{{ $value->heure_arrivee }}</span>
                                                                                </div>
                                                                                @if ($value->heure_depart !== null)
                                                                                    <div style="padding-top: 1rem;">
                                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="black" class="bi bi-door-closed-fill" viewBox="0 0 16 16">
                                                                                            <path d="M12 1a1 1 0 0 1 1 1v13h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V2a1 1 0 0 1 1-1h8zm-2 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                                                                        </svg>
                                                                                        Heure de depart
                                                                                        <span class="text-success">{{ $value->heure_depart }}</span>
                                                                                    </div>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div style="width:100%;height: 10%;padding-bottom: 1rem;display: flex;align-items:center;justify-content:center;">
                                                                            <div>
                                                                                Total d'heure(s)
                                                                                <span class="text-success">{{str_replace(":", 'h', $value->total_heure)}}m</span> 
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif

                                                        @if ($errors->any())
                                                            @foreach ($errors->all() as $error)
                                                                @if (intval($error) === 1)
                                                                    <div class="scan-error" style="
                                                                        width: 100%;
                                                                        height: 100%;
                                                                        display: flex;
                                                                        flex-direction: column;
                                                                        align-items: center;
                                                                        justify-content: center;
                                                                    ">
                                                                        <div class="text-danger" style="width: 80%;font-weight: bold;font-size: 1.1rem;margin: 2rem 0 2rem 0;text-align:center;">
                                                                            veuillez s'il vous plaît choisir une option "Heure d'arrivée, Heure de départ".
                                                                        </div>
                                                                    </div>
                                                                @endif

                                                                @if (intval($error) === 2)
                                                                    <div class="scan-error" style="
                                                                        width: 100%;
                                                                        height: 100%;
                                                                        display: flex;
                                                                        flex-direction: column;
                                                                        align-items: center;
                                                                        justify-content: center;
                                                                    ">
                                                                        <div class="text-danger" style="width: 80%;font-weight: bold;font-size: 1.1rem;margin: 2rem 0 2rem 0;text-align:center;">
                                                                            {{ (!$agent->sexe) ? "M." : "Mme" }}
                                                                            {{ strtoUpper($agent->nom).' '.strtoUpper($agent->prenom) }}
                                                                            à déjà pointé à l'arrivée, veuillez choisir l'option départ
                                                                        </div>
                                                                    </div>
                                                                @endif

                                                                @if (intval($error) === 3)
                                                                    <div class="scan-error" style="
                                                                        width: 100%;
                                                                        height: 100%;
                                                                        display: flex;
                                                                        flex-direction: column;
                                                                        align-items: center;
                                                                        justify-content: center;
                                                                    ">
                                                                        <div class="text-danger" style="width: 80%;font-weight: bold;font-size: 1.1rem;margin: 2rem 0 2rem 0;text-align:center;">
                                                                            {{ (!$agent->sexe) ? "M." : "Mme" }}
                                                                            {{ strtoUpper($agent->nom).' '.strtoUpper($agent->prenom) }}
                                                                            n'à pas été pointé à l'arrivée, veuillez choisir l'option arrivée
                                                                        </div>
                                                                    </div>
                                                                @endif

                                                                @if (intval($error) === 4)
                                                                    <div class="scan-error" style="
                                                                        width: 100%;
                                                                        height: 100%;
                                                                        display: flex;
                                                                        flex-direction: column;
                                                                        align-items: center;
                                                                        justify-content: center;
                                                                    ">
                                                                        <div class="text-danger" style="width: 80%;font-weight: bold;font-size: 1.1rem;margin: 2rem 0 2rem 0;text-align:center;">
                                                                            {{ (!$agent->sexe) ? "M." : "Mme" }}
                                                                            {{ strtoUpper($agent->nom).' '.strtoUpper($agent->prenom) }}
                                                                            à déjà pointé à son départ, veuillez attendre la journée de demain
                                                                        </div>
                                                                    </div>
                                                                @endif

                                                                @if (intval($error) === 5)
                                                                    <div class="scan-error" style="
                                                                        width: 100%;
                                                                        height: 100%;
                                                                        display: flex;
                                                                        flex-direction: column;
                                                                        align-items: center;
                                                                        justify-content: center;
                                                                    ">
                                                                        <div class="text-danger" style="width: 80%;font-weight: bold;font-size: 1.1rem;margin: 2rem 0 2rem 0;text-align:center;">
                                                                            Veuillez debuter une nouvelle journée pour effectuer un pointage
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                @endif
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

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>