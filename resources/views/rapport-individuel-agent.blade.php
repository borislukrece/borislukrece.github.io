<?php 
    use App\Models\Agent;
    use App\Models\Pointage;
    
    if (isset($_GET['agent']) && !empty($_GET['agent'])) {
        $id_agent = valid_donnees($_GET['agent']);
        if (Agent::find($id_agent) === null) {
            $id_agent = $_SESSION['id'];
        }
    }else{
        $id_agent = $_SESSION['id'];
    }
    
    $agent = Agent::find($id_agent);

    if ($agent !== null) {
        $nom_agent = $agent->nom." ".$agent->prenom;
    }else{
        $nom_agent = "Inconnue";
    }

    function valid_donnees($donnees){
        $donnees = trim($donnees);
        $donnees = stripslashes($donnees);
        $donnees = htmlspecialchars($donnees);

        return $donnees;
    }

    function getMoisLetter($i_mois,$i_year){
        $givenDate = new DateTime("$i_year-$i_mois-1");
        $givenDate = $givenDate->getTimestamp();

        return date('F', $givenDate);
    }

    function getFirstWorkingDay($month, $year) {
        $date = new DateTime("first day of $year-$month");
        while ($date->format('N') > 5) {
            $date->add(new DateInterval('P1D'));
        }
        return $date->format('Y-m-d');
    }

    date_default_timezone_set('UTC');
    $now = time();

    if (Pointage::first() !== null) {
        $debutPointage = new DateTime(Pointage::first()->date_actuelle);
        $debutPointage = $debutPointage->getTimestamp();
    }else{
        $debutPointage = time();
    }


    if (Pointage::latest('id')->first() !== null) {
        $lastedPointage = new DateTime(Pointage::latest('id')->first()->date_actuelle);
        $lastedPointage = $lastedPointage->getTimestamp();
    }else{
        $lastedPointage = time();
    }

    $firstDatePointage = date('Y-m-d', $debutPointage);
    $lastDatePointage = date('Y-m-d', $lastedPointage);

    $debutAnneeDePointage = date('Y', $debutPointage);

    if (isset($_GET['date']) && !empty($_GET['date'])) {
        $date = new DateTime(valid_donnees($_GET['date']));
        $date = $date->getTimestamp();
    }else{
        $date = time();
    }

    $givenDate = date('Y-m-d', $date);

    $dateDebut = new DateTime("$firstDatePointage");
    $dateFin = new DateTime("$lastDatePointage");
    $dateDonne = new DateTime("$givenDate");

    if ($dateDonne > $dateFin) {
        $date = $dateFin->getTimestamp();
    } elseif ($dateDonne < $dateDebut) {
        $date = $dateDebut->getTimestamp();
    }

    $SET_YEAR = intval(date('Y', $date));
    $SET_MONTH = intval(date('m', $date));

    if ($SET_YEAR === intval(date('Y', $now)) && $SET_MONTH === intval(date('m', $now))){
        if($SET_MONTH === 1){
            $SET_MONTH = 12;
            $SET_YEAR = $SET_YEAR - 1;
        }else{
            $SET_MONTH = $SET_MONTH - 1;
        }
    }

    // Nombre de Jours Ouvrables
    $given_date = "$SET_YEAR-$SET_MONTH-1";

    $given_year = date('Y', strtotime($given_date));
    $given_month = date('m', strtotime($given_date));
    $nbr_jrs_mois = cal_days_in_month(CAL_GREGORIAN, $SET_MONTH, $SET_YEAR);

    $nbr_jrs_ouvres = 0;
    for ($i=0; $i < $nbr_jrs_mois; $i++) { 
        if ($i < 10) $jrs = "0".$i;
        else $jrs = $i;
        $req = Pointage::where('date_actuelle', "$given_year-$given_month-$jrs");
        if ($req->exists()) {
            $nbr_jrs_ouvres++;
        }
    }

    // Nombre de Jours non Travaillé
    $given_date = "$SET_YEAR-$SET_MONTH-1";

    $given_year = date('Y', strtotime($given_date));
    $given_month = date('m', strtotime($given_date));
    $nbr_jrs_mois = cal_days_in_month(CAL_GREGORIAN, $SET_MONTH, $SET_YEAR);

    $nbr_jrs_non_travaille = 0;
    for ($i=0; $i < $nbr_jrs_mois; $i++) { 
        if ($i < 10) $jrs = "0".$i;
        else $jrs = $i;
        $req = Pointage::where('date_actuelle', "$given_year-$given_month-$jrs");
        if (!$req->exists()) {
            $nbr_jrs_non_travaille++;
        }
    }

    // Durée d'absence
    $given_date = "$SET_YEAR-$SET_MONTH-1";

    $given_year = date('Y', strtotime($given_date));
    $given_month = date('m', strtotime($given_date));
    $nbr_jrs_mois = cal_days_in_month(CAL_GREGORIAN, $SET_MONTH, $SET_YEAR);

    $duree_absence = 0;
    $non_justifie = 0;

    for ($i=0; $i < $nbr_jrs_mois; $i++) {
        if ($i < 10) $jrs = "0".$i;
        else $jrs = $i;
        $req = Pointage::where('date_actuelle', "$given_year-$given_month-$jrs")->where('id_agent', $agent->id);
        if ($req->exists()) {
            $reqPointage = $req->get()[0];
            if ($reqPointage->heure_arrivee === null || $reqPointage->heure_depart === null) {
                if ($reqPointage->motif === null) {
                    $non_justifie++;
                }
                $duree_absence++;
            }
        }
    }

    // Durée de presence
    $given_date = "$SET_YEAR-$SET_MONTH-1";

    $given_year = date('Y', strtotime($given_date));
    $given_month = date('m', strtotime($given_date));
    $nbr_jrs_mois = cal_days_in_month(CAL_GREGORIAN, $SET_MONTH, $SET_YEAR);

    $duree_presence = 0;

    for ($i=0; $i < $nbr_jrs_mois; $i++) {
        if ($i < 10) $jrs = "0".$i;
        else $jrs = $i;
        $req = Pointage::where('date_actuelle', "$given_year-$given_month-$jrs")->where('id_agent', $agent->id);
        if ($req->exists()) {
            $reqPointage = $req->get()[0];
            if ($reqPointage->heure_arrivee !== null && $reqPointage->heure_depart !== null) {
                $duree_presence++;
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ strtoupper($agent->nom) }} {{ $agent->prenom }} - Rapport Individuel de {{getMoisLetter($SET_MONTH,$SET_YEAR)}}-{{$SET_YEAR}}</title>
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
                <div style="width: 100%; height: 100%;">
                    <div style="width: 100%; height: 100%; display: flex;">
                        <div style="
                            width: 100%;
                            height: 100%;
                            background: rgba(255, 255, 255, 0.8);
                            padding: 1rem;
                        ">
                            <div style="
                                width: 100%;
                                height: 100%;
                            ">
                                <div style="font-weight: bold;font-size: 1.4rem;">Rapport Individuel <span style="color: gray;">({{ strtoupper($agent->nom) }} {{ $agent->prenom }})</span> | <span class="select_date">{{getMoisLetter($SET_MONTH,$SET_YEAR)}} {{$SET_YEAR}}</span></div>
                                <div style="display: flex;">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <select class="form-select form-control" id="date_mois" name="date_mois" autocomplete="off" aria-label="Default select">
                                                <?php 
                                                    for ($mois = 1; $mois <= 12; $mois++) {
                                                        if ($mois === $SET_MONTH) {
                                                            $select = "selected";
                                                        }else{
                                                            $select = "";
                                                        }
                                            
                                                        if (!($mois === intval(date('m', $now)) && $SET_YEAR === intval(date('Y', $now)))){
                                                            echo "<option $select value='$mois'>".getMoisLetter($mois,$SET_YEAR)."</option>";
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-1" style="margin-left: 1rem;">
                                        <div class="form-group">
                                            <select class="form-select form-control" id="date_annee" name="date_annee" autocomplete="off" aria-label="Default select">
                                                <?php
                                                    for ($annee = $debutAnneeDePointage-1; $annee <= intval(date('Y', $now)); $annee++){
                                                        $select = "";
                                                        if ($annee === $SET_YEAR) {
                                                            $select = "selected";
                                                        }else{
                                                            $select = "";
                                                        }

                                                        echo "<option $select value=".$annee.">$annee</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <a href="" id="rapport" class="col-md-1 btn btn-primary" style="margin-left: 1rem;">Rapport</a>
                                </div>
                                <div style="
                                    width: 100%;
                                    display: flex;
                                    margin-top: 2rem;
                                ">
                                    <div style="
                                        width: 50%;
                                        height: 100%;
                                    ">
                                        <!-- MONTH -->
                                        <div style="
                                            width: 100%;
                                            height: 100%;
                                        ">
                                            <div style="
                                                width: 100%;
                                                height: 8%;
                                                display: grid;
                                                grid-template-columns:repeat(5, 1fr);
                                                font-weight: bold;
                                            ">
                                                <div id="semaine-1" style="width: 100%;display: flex;align-items: center;justify-content: center;
                                                <?php 
                                                    if($SET_MONTH === intval(date('m', $now)) && $SET_YEAR === intval(date('Y', $now))){
                                                        if (intval(date("N", $now)) === 1) {
                                                            echo "border-bottom: solid 6px #317AC1";
                                                        }else{
                                                            echo "border-bottom: solid 0 #00000000";
                                                        }
                                                    }else{
                                                        echo "border-bottom: solid 0 #00000000";
                                                    }
                                                ?>
                                                ">Lun</div>
                                                <div id="semaine-2" style="width: 100%;display: flex;align-items: center;justify-content: center;
                                                <?php 
                                                    if($SET_MONTH === intval(date('m', $now)) && $SET_YEAR === intval(date('Y', $now))){
                                                        if (intval(date("N", $now)) === 2) {
                                                            echo "border-bottom: solid 6px #317AC1";
                                                        }else{
                                                            echo "border-bottom: solid 0 #00000000";
                                                        }
                                                    }else{
                                                        echo "border-bottom: solid 0 #00000000";
                                                    }
                                                ?>
                                                ">Mar</div>
                                                <div id="semaine-3" style="width: 100%;display: flex;align-items: center;justify-content: center;
                                                <?php 
                                                    if($SET_MONTH === intval(date('m', $now)) && $SET_YEAR === intval(date('Y', $now))){
                                                        if (intval(date("N", $now)) === 3) {
                                                            echo "border-bottom: solid 6px #317AC1";
                                                        }else{
                                                            echo "border-bottom: solid 0 #00000000";
                                                        }
                                                    }else{
                                                        echo "border-bottom: solid 0 #00000000";
                                                    }
                                                ?>
                                                ">Mer</div>
                                                <div id="semaine-4" style="width: 100%;display: flex;align-items: center;justify-content: center;
                                                <?php 
                                                    if($SET_MONTH === intval(date('m', $now)) && $SET_YEAR === intval(date('Y', $now))){
                                                        if (intval(date("N", $now)) === 4) {
                                                            echo "border-bottom: solid 6px #317AC1";
                                                        }else{
                                                            echo "border-bottom: solid 0 #00000000";
                                                        }
                                                    }else{
                                                        echo "border-bottom: solid 0 #00000000";
                                                    }
                                                ?>
                                                ">Jeu</div>
                                                <div id="semaine-5" style="width: 100%;display: flex;align-items: center;justify-content: center;
                                                <?php 
                                                    if($SET_MONTH === intval(date('m', $now)) && $SET_YEAR === intval(date('Y', $now))){
                                                        if (intval(date("N", $now)) === 5) {
                                                            echo "border-bottom: solid 6px #317AC1";
                                                        }else{
                                                            echo "border-bottom: solid 0 #00000000";
                                                        }
                                                    }else{
                                                        echo "border-bottom: solid 0 #00000000";
                                                    }
                                                ?>
                                                ">Ven</div>
                                            </div>
                                            <div id="day-list" style="
                                                width: 100%;
                                                height: 92%;
                                                display: grid;
                                                grid-template-columns:repeat(5, 1fr);
                                            ">
                                                <!-- LISTE JOURZ MOIS -->
                                                <?php
                                                    function getInfoPointageDay($annee,$mois,$jours,$id){
                                                        $BACKGROUND_NORMAL = 'rgba(174, 174, 174, 0.771)';
                                                        $BACKGROUND_CURRENT = '#317AC1';
                                                        $BACKGROUND_SUCCESS = 'rgba(0, 128, 0, 0.771)';
                                                        $BACKGROUND_DANGER = 'rgba(255, 0, 0, 0.771)';
                                                        $BACKGROUND_JUSTIFIER = 'rgba(255, 0, 0, 0.571)';
                                                        $BACKGROUND_FERIE = 'rgba(0, 0, 0, 1)';

                                                        $idDay = "idDay$jours";

                                                        date_default_timezone_set('UTC');
                                                        $now = time();
                                                        $currentDate = date('Y-m-d', $now);
                                                        $current_day = date('d', strtotime($currentDate));
                                                        $current_month = date('m', strtotime($currentDate));
                                                        $current_year = date('Y', strtotime($currentDate));

                                                        $date = "$annee-$mois-$jours";
                                                        $day = date('d', strtotime($date));
                                                        $month = date('m', strtotime($date));
                                                        $year = date('Y', strtotime($date));

                                                        $reqPointage = Pointage::where('date_actuelle', "$year-$month-$day")->where('id_agent', $id);

                                                        ?>
                                                            <div id="$idDay" style="width: 100%;height: 10%;cursor: pointer;">
                                                            <?php 
                                                                if ($year === $current_year && $month === $current_month && $day === $current_day) {
                                                                    $BACKGROUND = $BACKGROUND_CURRENT;
                                                                    $SEND = '<div style="width: 100%;height: 100%;display: flex;align-items: center;justify-content:center;color: rgba(0, 0, 0, 0.622);font-size: 0.8rem;">Journée en cours</div>';              
                                                                    $onclick = "";
                                                                }else{
                                                                    if ($reqPointage->exists()) {
                                                                        $recupInfoPointage = $reqPointage->get()[0];

                                                                        if ($recupInfoPointage->heure_arrivee !== null && $recupInfoPointage->heure_depart !== null) {
                                                                            $BACKGROUND = $BACKGROUND_SUCCESS;
                                                                            $SEND = '<div title="Heure total(s)'.str_replace(":", 'h', $recupInfoPointage->total_heure).'m" style="width: 100%; height: 100%;display: flex;align-items: center;justify-content:center;color: rgba(255, 255, 255, 0.622);font-size: 0.6rem;">'.$recupInfoPointage->heure_arrivee.' / '.$recupInfoPointage->heure_depart.'</div><div style="width: 100%;height: 100%;display: flex;align-items: center;justify-content:center;color: rgba(255, 255, 255, 0.622);font-size: 0.6rem;">H.T. '.str_replace(":", 'h', $recupInfoPointage->total_heure).'m</div>';
                                                                            $onclick = "";
                                                                        }else{
                                                                            $BACKGROUND = $BACKGROUND_DANGER;
                                                                            $verifAdmins = Agent::find(intval($_SESSION['id']));

                                                                            if (strlen($recupInfoPointage->motif) >= 10) {
                                                                                $motif = substr("$recupInfoPointage->motif", 0, 10).'...';
                                                                            }else{
                                                                                $motif = $recupInfoPointage->motif;
                                                                            }

                                                                            if ($recupInfoPointage->motif !== null) {
                                                                                $BACKGROUND = $BACKGROUND_JUSTIFIER;
                                                                                $SEND = '<div style="width: 100%;height: 100%;display: flex;align-items: center;justify-content:center;color: rgba(255, 255, 255, 0.622);font-size: 0.8rem;" title="'.$recupInfoPointage->motif.'">'.$motif.'</div>';
                                                                                
                                                                                if($verifAdmins->exists()){
                                                                                    if ($verifAdmins->admins) {
                                                                                        $onclick = "justify('$year-$month-$day','$id')";
                                                                                    }else{
                                                                                        $onclick = "";
                                                                                    }
                                                                                }
                                                                            }else{
                                                                                $SEND = '<div style="width: 100%;height: 100%;display: flex;align-items: center;justify-content:center;color: #000000C0;font-size: 0.8rem;">Non Justifié</div>';
                                                                                
                                                                                if($verifAdmins->exists()){
                                                                                    if ($verifAdmins->admins) {
                                                                                        $onclick = "justify('$year-$month-$day','$id')";
                                                                                    }else{
                                                                                        $onclick = "";
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    }else{
                                                                        $BACKGROUND = $BACKGROUND_NORMAL;
                                                                        $SEND = '';
                                                                        $onclick = "";
                                                                    }
                                                                }

                                                                if (intval($month) === 1 && intval($day) === 1){
                                                                    $text = "Jour de l'An";
                                                                    $SEND = '<div style="
                                                                    width: 100%;
                                                                    height: 100%;
                                                                    display: flex;
                                                                    align-items: center;
                                                                    justify-content:center;
                                                                    color: gray;
                                                                    font-size: 0.8rem;" 
                                                                    title="'.$text.'">
                                                                        '.$text.'
                                                                    </div>';
                                                                    $BACKGROUND = $BACKGROUND_FERIE;
                                                                    $onclick = "";
                                                                    $color = "color: gray";
                                                                } else if (intval($month) === 5 && intval($day) === 1) {
                                                                    $text = "Fête du Travail";
                                                                    $SEND = '<div style="
                                                                    width: 100%;
                                                                    height: 100%;
                                                                    display: flex;
                                                                    align-items: center;
                                                                    justify-content:center;
                                                                    color: gray;
                                                                    font-size: 0.8rem;" 
                                                                    title="'.$text.'">
                                                                        '.$text.'
                                                                    </div>';
                                                                    $BACKGROUND = $BACKGROUND_FERIE;
                                                                    $onclick = "";
                                                                    $color = "color: gray";
                                                                } else if (intval($month) === 12 && intval($day) === 25) {
                                                                    $text = "Noël";
                                                                    $SEND = '<div style="
                                                                    width: 100%;
                                                                    height: 100%;
                                                                    display: flex;
                                                                    align-items: center;
                                                                    justify-content:center;
                                                                    color: gray;
                                                                    font-size: 0.8rem;" 
                                                                    title="'.$text.'">
                                                                        '.$text.'
                                                                    </div>';
                                                                    $BACKGROUND = $BACKGROUND_FERIE;
                                                                    $onclick = "";
                                                                    $color = "color: gray";
                                                                } else if (intval($month) === 12 && intval($day) === 26) {
                                                                    $text = "Lendemain de Noël";
                                                                    $SEND = '<div style="
                                                                    width: 100%;
                                                                    height: 100%;
                                                                    display: flex;
                                                                    align-items: center;
                                                                    justify-content:center;
                                                                    color: gray;
                                                                    font-size: 0.8rem;" 
                                                                    title="'.$text.'">
                                                                        '.$text.'
                                                                    </div>';
                                                                    $BACKGROUND = $BACKGROUND_FERIE;
                                                                    $onclick = "";
                                                                    $color = "color: gray";
                                                                }else{
                                                                    $color = "";
                                                                }

                                                                $return = '<div class="day" onclick="'.$onclick.'" style="
                                                                    width: 100%;
                                                                    height: 10vh;
                                                                    font-weight: bold;
                                                                    border: solid 1px rgba(255, 255, 255, 0.4);
                                                                    background: '.$BACKGROUND.';
                                                                    overflow: hidden;
                                                                ">
                                                                    <div style="padding: 0.5rem 0 0 0.5rem;">
                                                                        <div id="box-day-3" style="'.$color.'">'.$day.'</div>
                                                                        '.$SEND.'
                                                                    </div>
                                                                </div>';

                                                                echo $return;
                                                            ?>
                                                            </div>
                                                        <?php
                                                    }

                                                    for ($i = 1; $i <= 7; $i++){
                                                        $getDebutMois = new DateTime(getFirstWorkingDay($SET_MONTH,$SET_YEAR));
                                                        $getDebutMois = $getDebutMois->getTimestamp();
                                                        $datestart = intval(date('N', $getDebutMois));
                                                        if ($i===$datestart) {
                                                            for ($j = 1; $j <= cal_days_in_month(CAL_GREGORIAN, $SET_MONTH, $SET_YEAR); $j++) {
                                                                $dateVerifWeekend = new DateTime("$SET_YEAR-$SET_MONTH-$j");
                                                                $dateVerifWeekend = $dateVerifWeekend->getTimestamp();
                                                                if(intval(date("N", $dateVerifWeekend)) !== 7 && intval(date("N", $dateVerifWeekend)) !== 6){
                                                                    getInfoPointageDay($SET_YEAR,$SET_MONTH,$j,$agent->id);
                                                                }
                                                            }
                                                        }else{
                                                            echo  '<div style="width: 100%;height: 10%;"></div>';
                                                        }
                                                    }
                                                ?>
                                                <!-- END LISTE JOURZ MOIS -->
                                            </div>
                                        </div>
                                        <!-- END MONTH -->
                                    </div>
                                    <div style="
                                        width: 50%;
                                        height: 100%;
                                    ">
                                        <div style="
                                            width: 100%;
                                            height: 100%;
                                            padding-left: 4rem;
                                        ">
                                            <div>Employé: <span style="font-weight: bold;">{{ strtoupper($agent->nom) }} {{ $agent->prenom }}</span></div>
                                            <div style="padding-top: 1rem;">Date: <span class="select_date" style="font-weight: bold;">{{getMoisLetter($SET_MONTH,$SET_YEAR)}} {{$SET_YEAR}}</span></div>
                                            <div style="padding-top: 1rem;">Nombre de jours: <span class="select_date_nbrjrs" style="font-weight: bold;">{{cal_days_in_month(CAL_GREGORIAN, $SET_MONTH, $SET_YEAR)}}</span></div>
                                            <div style="padding-top: 1rem;">Nombre de jours ouvrés: <span id="select_date_nbrjrs_ouvres" style="font-weight: bold;">{{$nbr_jrs_ouvres}}</span></div>
                                            <div style="padding-top: 1rem;">Nombre de jours non travaillés: <span id="select_date_nbrjrs_non_travailles" style="color:gray;font-weight: bold;">{{$nbr_jrs_non_travaille}}</span></div>
                                            <div style="padding-top: 1rem;">Durée d'absences: <span id="select_date_duree_absence" style="font-weight: bold;">{{$duree_absence}} / <span style='color: gray;'>Non justifié </span> {{$non_justifie}}</span></div>
                                            <div style="padding-top: 1rem;">Durée de présences: <span id="select_date_duree_presence" style="font-weight: bold;">{{$duree_presence}}</span></div>
                                            <div style="margin-top: 1rem;"><a class="btn btn-info" href="generer-rapport/{{$agent->id}}/{{$SET_YEAR}}-{{$SET_MONTH}}-01">Generer rapport</a></div>
                                            @if (\Session::has('success'))
                                                <div style="margin-top: 1rem;">
                                                    <a href="{{asset("pdf/$agent->id.pdf")}}" download="{{ $nom_agent.'.pdf' }}" style="padding-top: 0.5rem;color:#EC9628;">Télécharger le rapport de stage en PDF</a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>