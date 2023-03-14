<?php
use Ramsey\Uuid\Uuid;

use App\Models\Agent;
use App\Models\Service;
use App\Models\Fonction;
use App\Models\Sous_direction;
use App\Models\Direction;
use App\Models\CodeQr;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

$id_connected = $_SESSION['id'];

$agentConnected = Agent::find($id_connected);

$nom_connecte = $agentConnected->nom;
$prenom_connecte = $agentConnected->prenom;
$sexe_connecte = $agentConnected->sexe;
$date_naissance_connecte = $agentConnected->date_naissance;
$lieu_naissance_connecte = $agentConnected->lieu_naissance;
$tel_connecte = $agentConnected->tel;
$fonction_connecte = $agentConnected->id_fonction;
$service_connecte = $agentConnected->id_service;
$adresse_connecte = $agentConnected->adresse;
$email_connecte = $agentConnected->email;
$username_connecte = $agentConnected->username;

$service = Service::find($service_connecte);
$fonction = Fonction::find($fonction_connecte);

if (intval($service->id_sous_direction) === 0) {
    $sous_direction = 'NULL';
} else {
    $search_sous_direction = Sous_direction::find($service->id_sous_direction);
    $sous_direction = $search_sous_direction->libelle;
}

if (intval($service->id_sous_direction) === 0) {
    $search_direction = Direction::find(1);
    $direction = $search_direction->libelle;
} else {
    $search_sous_direction = Sous_direction::find($service->id_sous_direction);
    $search_direction = Direction::find($search_sous_direction->id_direction);
    $direction = $search_direction->libelle;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mon profil</title>
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.2.2/font/bootstrap-icons.css" rel="stylesheet">

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>

    <!-- Custom asset -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script defer src="{{ asset('js/main.js') }}"></script>
</head>

<body class="antialiased">
    <section>

        <div style="
            display: flex;
        ">
            {{-- SLIDER --}}
            <x-comp-slider />
            {{-- FIN SLIDER --}}

            <div
                style="
                width: 95vw;
                height: 100vh;
                background: rgb(131, 84, 84);
                background-image: url('{{ asset('img/fond.jpg') }}');
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: cover;
            ">
                {{-- HEADER --}}
                <x-comp-header />
                {{-- FIN HEADER --}}

                <div style="width: 100%; height: 92vh; display: flex; align-items: center; jsutify-content: center;">
                    <div style="width: 100%; height: 92vh; display: flex;">
                        <div
                            style="
                            width: 95%;
                            height: 100%;
                            background: rgba(255, 255, 255, 0.4);
                        ">
                            <div
                                style="
                                height: 100%;
                                padding-left: 2%;
                                padding-top: 2%;
                            ">
                                {{-- NAV BAR --}}
                                <x-comp-nav-bar />
                                {{-- END NAV BAR --}}

                                <div style="height: 2%;"></div>
                                <div
                                    style="
                                    width: 100%;
                                    height: 90%;
                                ">
                                    <div
                                        style="
                                        height: 100%;
                                        border-top: solid 1px #EC9628;
                                    ">
                                        <div
                                            style="
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
                                            Mon dossier personnel&nbsp;<span style="color: #EC9628;"> / PROFIL</span>
                                        </div>

                                        <div
                                            style="
                                            width: 100%;
                                            height: 90%;
                                            background: rgb(216, 216, 216);
                                            overflow-y: scroll;
                                            overflow-x: hidden;
                                        ">
                                            <div
                                                style="
                                                width: 100%;
                                                height: 100%;
                                                padding: 1rem;
                                                display: flex;
                                            ">
                                                <div
                                                    style="
                                                    width: 80%;
                                                    height: 100%;
                                                    display: flex;
                                                    align-items: center;
                                                    justify-content: center;
                                                ">
                                                    <div
                                                        style="
                                                        width: 100%;
                                                        height: 90%;
                                                        display: flex;
                                                    ">
                                                        <div
                                                            style="width: 80%;margin-top:1rem;line-height: 2.5rem;padding-left: 1rem;border-left: solid 0 gray;border-right: solid 1px gray;">
                                                            <div>
                                                                <span>Nom: </span>
                                                                <span
                                                                    style="
                                                                    padding-left: 1rem;
                                                                    color: #EC9628;
                                                                ">{{ $nom_connecte }}</span>
                                                            </div>

                                                            <div>
                                                                <span>Prenom: </span>
                                                                <span
                                                                    style="
                                                                    padding-left: 1rem;
                                                                    color: #EC9628;
                                                                ">{{ $prenom_connecte }}</span>
                                                            </div>

                                                            <div>
                                                                <span>Sexe: </span>
                                                                <span
                                                                    style="
                                                                    padding-left: 1rem;
                                                                    color: #EC9628;
                                                                ">{{ !$sexe_connecte ? 'M' : 'F' }}</span>
                                                            </div>

                                                            <div>
                                                                <span>Date de naissance: </span>
                                                                <span
                                                                    style="
                                                                    padding-left: 1rem;
                                                                    color: #EC9628;
                                                                ">{{ $date_naissance_connecte }}</span>
                                                            </div>

                                                            <div>
                                                                <span>Lieu de naissance: </span>
                                                                <span
                                                                    style="
                                                                    padding-left: 1rem;
                                                                    color: #EC9628;
                                                                ">{{ $lieu_naissance_connecte }}</span>
                                                            </div>

                                                            <div>
                                                                <span>Telephone: </span>
                                                                <span
                                                                    style="
                                                                    padding-left: 1rem;
                                                                    color: #EC9628;
                                                                ">{{ $tel_connecte }}</span>
                                                            </div>

                                                            <div>
                                                                <span>Adresse: </span>
                                                                <span
                                                                    style="
                                                                    padding-left: 1rem;
                                                                    color: #EC9628;
                                                                ">{{ $adresse_connecte }}</span>
                                                            </div>
                                                        </div>

                                                        <div
                                                            style="width: 80%;margin-top:1rem;line-height: 2.5rem;padding-left: 1rem;border-left: solid 1px gray;border-right: solid 1px gray;">
                                                            <div>
                                                                <span>Direction: </span>
                                                                <span
                                                                    style="
                                                                    padding-left: 1rem;
                                                                    color: #EC9628;
                                                                ">{{ $direction }}</span>
                                                            </div>

                                                            <div>
                                                                <span>Sous Direction: </span>
                                                                <span
                                                                    style="
                                                                    padding-left: 1rem;
                                                                    color: #EC9628;
                                                                "><?php if ($sous_direction === "NULL") {
                                                                    ?>
                                                                    <span style="color: gray;">(Aucune sous
                                                                        direction)</span> Secrétariat
                                                                    <?php
                                                                }else{
                                                                    echo $sous_direction;
                                                                } ?></span>
                                                            </div>

                                                            <div>
                                                                <span>Service: </span>
                                                                <span
                                                                    style="
                                                                    padding-left: 1rem;
                                                                    color: #EC9628;
                                                                ">{{ $service->libelle }}</span>
                                                            </div>

                                                            <div>
                                                                <span>Fonction: </span>
                                                                <span
                                                                    style="
                                                                    padding-left: 1rem;
                                                                    color: #EC9628;
                                                                ">{{ $fonction->nom }}</span>
                                                            </div>

                                                            <div>
                                                                <span>Email: </span>
                                                                <span
                                                                    style="
                                                                    padding-left: 1rem;
                                                                    color: #EC9628;
                                                                ">{{ $email_connecte }}</span>
                                                            </div>

                                                            <div>
                                                                <span>Nom d'utilisateur: </span>
                                                                <span
                                                                    style="
                                                                    padding-left: 1rem;
                                                                    color: #EC9628;
                                                                ">{{ $username_connecte }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    style="
                                                    width: 20%;
                                                    height: 70%;
                                                    display: flex;
                                                    align-items: center;
                                                    justify-content: center;
                                                ">
                                                    <div
                                                        style="
                                                        width: 100%;
                                                        height: 100%;
                                                        display: flex;
                                                        flex-direction: column;
                                                        align-items: center;
                                                        justify-content: center;
                                                    ">
                                                        <?php
                                                        $myuuid = Uuid::uuid4();
                                                        $path = '../public/qrcodes/' . $id_connected . '.svg';
                                                        $filename = "/qrcodes/$id_connected.svg";
                                                        
                                                        $qr = CodeQr::where('id_user', $id_connected)->get();
                                                        
                                                        if (!count($qr)) {
                                                            QrCode::size(200)->generate($myuuid, $path);
                                                            CodeQr::create([
                                                                'id_user' => $id_connected,
                                                                'token' => $myuuid,
                                                            ]);
                                                        } else {
                                                            if (!file_exists("../public/$filename")) {
                                                                $updateQr = CodeQr::where('id_user', $id_connected)->get();
                                                                if (count($updateQr)) {
                                                                    CodeQr::destroy($updateQr[0]->id);
                                                                    echo "<script> window.location.href = '/menu/profil';</script>";
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                        <div style="padding-top: 0.5rem;color:#00000084;">Votre QR Code
                                                            personnel</div>
                                                        <img src="{{ $filename }}" alt="QR Code"
                                                            style="width: 80%;height: auto;padding: 2rem;">
                                                        <div
                                                            style="width: 50%;height: 3px;background:rgba(0, 0, 0, 0.356);">
                                                            &nbsp;</div>
                                                        <a href="{{ $filename }}"
                                                            download="{{ $nom_connecte . '.svg' }}"
                                                            style="padding-top: 0.5rem;color:#EC9628;">Télécharger le QR
                                                            Code </a>
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
                        <div
                            style="
                                        width:5%;
                                        height: 100%;
                                        background: rgba(255, 255, 255, 0.4);
                                        box-shadow: 0 4px 2px 3px rgba(0, 0, 0, 0.26);
                                    ">
                            &nbsp;</div>
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
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
</body>

</html>
