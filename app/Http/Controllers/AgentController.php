<?php

namespace App\Http\Controllers;

use Ramsey\Uuid\Uuid;

use App\Models\Service;
use App\Models\Fonction;
use App\Models\Agent;
use App\Models\CodeQr;
use Illuminate\Http\Request;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

session_start();

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

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userlogin = strtolower(valid_donnees($_POST['username']));
        $mdplogin = valid_donnees($_POST['mdp']);

        if(!empty($userlogin)){
            $personSearchLogin = Agent::where('username', $userlogin)->get();
            if(count($personSearchLogin) >= 1){
                foreach ($personSearchLogin as $key => $value) {
                    if($userlogin === $value->username){
                        if($mdplogin === $value->mdp){
                            // Connecter l'utilisateur
                            $_SESSION["id"] = $value->id;
                            $_SESSION["admins"] = $value->administrateur;
                            return redirect('/');
                        }else{
                            // Le mot de passe ne correspont pas
                            return redirect()->back()->withErrors('4');
                        }
                    }else{
                        // Aucun nom d'utilisateur trouver
                        return redirect()->back()->withErrors('3');
                    }
                }
            }else{
                return redirect()->back()->withErrors('2');
            }
        }else{
            return redirect()->back()->withErrors('1');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (isset($_SESSION["id"]) && !empty($_SESSION["id"])) {
            // Connected
            $retAdmins = Agent::find(intval($_SESSION['id']));
            $retAdmins = $retAdmins->admins;

            if ($retAdmins){
                return view('ajouter-agent');
            }else{
                return redirect('/');
            }
        } else {
            return redirect('/connexion');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (isset($_SESSION["id"]) && !empty($_SESSION["id"])){

            $_SESSION['input_nom'] = trim(breakPhrase(valid_donnees($request['nom'])));
            $_SESSION['input_prenom'] = trim(breakPhrase(valid_donnees($request['prenom'])));
            $_SESSION['input_tel'] = valid_donnees($request['tel']);
            $_SESSION['input_sexe'] = intval(valid_donnees($request['sexe']));
            $_SESSION['input_date_naissance'] = valid_donnees($request['date_naissance']);
            $_SESSION['input_lieu_naissance'] = trim(breakPhrase(valid_donnees($request['lieu_naissance'])));
            $_SESSION['input_id_fonction'] = intval(valid_donnees($request['id_fonction']));
            $_SESSION['input_id_service'] = intval(valid_donnees($request['id_service']));
            $_SESSION['input_adresse'] = trim(breakPhrase(valid_donnees($request['adresse'])));
            $_SESSION['input_email'] = valid_donnees(strtolower($request['email']));
            $_SESSION['input_username'] = valid_donnees(strtolower($request['username']));
            $_SESSION['input_admins'] = intval(valid_donnees($request['admins']));

            $request->validate([
                'nom' => ['required', 'between:1,30'],
                'prenom' => ['required', 'between:1,30'],
                'tel' => ['required','numeric'],
                'sexe' => ['required', 'between:1,2'],
                'date_naissance' => ['required', 'before:01-01-2010'],
                'lieu_naissance' => ['required', 'between:1,125'],
                'id_service' => ['required', 'numeric', 'min:1'],
                'id_fonction' => ['required','numeric', 'min:1'],
                'adresse' => ['nullable', 'max:255'],
                'email' => ['required', 'email'],
                'username' => ['required', 'unique:agents'],
                'mdp' => ['required', 'min:8', 'same:mdp2'],
                'admins' => ['required', 'boolean']
            ]);

            if(strlen(valid_donnees($request['tel'])) === 10){
                Agent::create([
                    'nom' => trim(breakPhrase(valid_donnees($request['nom']))),
                    'prenom' => trim(breakPhrase(valid_donnees($request['prenom']))),
                    'tel' => valid_donnees($request['tel']),
                    'sexe' => intval(valid_donnees($request['sexe'])),
                    'date_naissance' => valid_donnees($request['date_naissance']),
                    'lieu_naissance' => trim(breakPhrase(valid_donnees($request['lieu_naissance']))),
                    'id_fonction' => intval(valid_donnees($request['id_fonction'])),
                    'id_service' => intval(valid_donnees($request['id_service'])),
                    'adresse' => trim(breakPhrase(valid_donnees($request['adresse']))),
                    'email' => valid_donnees(strtolower($request['email'])),
                    'username' => valid_donnees(strtolower($request['username'])),
                    'mdp' => $request->mdp,
                    'admins' => intval(valid_donnees($request['admins'])),
                ]);

                $recupDernierAgent = Agent::all()->sortBy('id')->last();
                if ($recupDernierAgent->username === valid_donnees(strtolower($request['username']))) {
                    $myuuid = Uuid::uuid4();
                    $path = '../public/qrcodes/'.$recupDernierAgent->id.'.svg';
                    $filename = "/qrcodes/$recupDernierAgent->id.svg";

                    $qr = CodeQr::where('id_user', $recupDernierAgent->id)->get();

                    if (!count($qr)) {
                        QrCode::size(200)->generate($myuuid, $path);
                        CodeQr::create([
                            "id_user" => $recupDernierAgent->id,
                            "token" => $myuuid,
                        ]);
                    }
                }  
                
                unset($_SESSION['input_nom']);
                unset($_SESSION['input_prenom']);
                unset($_SESSION['input_tel']);
                unset($_SESSION['input_sexe']);
                unset($_SESSION['input_date_naissance']);
                unset($_SESSION['input_lieu_naissance']);
                unset($_SESSION['input_id_fonction']);
                unset($_SESSION['input_id_service']);
                unset($_SESSION['input_adresse']);
                unset($_SESSION['input_email']);
                unset($_SESSION['input_username']);
                unset($_SESSION['input_admins']);

                $message = "L'employé ".trim(breakPhrase(valid_donnees($request['nom'])))." ".trim(breakPhrase(valid_donnees($request['prenom'])))." a été ajouter avec success";
                return redirect('/liste-agents')->with('success', $message);
            }else{
                return redirect()->back()->withErrors(['length'=>'Le numero de téléphone doit être de 10 caractères']);
            }
        }else {
            return redirect('/connexion');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id = null)
    {
        if (isset($_SESSION["id"]) && !empty($_SESSION["id"])) {
            // Connected
            $id = $_SESSION['id'];

            if (intval($request['form']) === 1) {
                $request->validate([
                    'tel' => ['required','numeric'],
                    'adresse' => ['nullable', 'max:255'],
                    'email' => ['required', 'email'],
                ]);

                $tel = Agent::find($id)->tel;
                $adresse = Agent::find($id)->adresse;
                $email = Agent::find($id)->email;

                if (!(strtolower($tel) === strtolower($request['tel']) && strtolower($adresse) === strtolower($request['adresse']) && strtolower($email) === strtolower($request['email']))) {
                    $return = Agent::find($id)->update([
                        'tel' => valid_donnees($request['tel']),
                        'adresse' => trim(breakPhrase(valid_donnees($request['adresse']))),
                        'email' => valid_donnees(strtolower($request['email'])),
                    ]);
                }

                if (!isset($return)) {
                    $return = false;
                }

                if ($return) {
                    $message = "Les modifications apporté ont été enregistré avec success";
                    return redirect()->back()->with('success', $message);
                }else{
                    return redirect()->back();
                }
            } else if(intval($request['form']) === 2){
                $UsernameRetVal = (isset($request->username) && !empty($request->username)) ? 1 : 0 ;
                $MdpRetVal = (isset($request->mdp) && !empty($request->mdp) && isset($request->mdp2) && !empty($request->mdp2)) ? 1 : 0 ;

                if ($UsernameRetVal) {
                    if (strtolower($request['username']) !== strtolower(Agent::find($id)->username)) {
                        $request->validate([
                            'username' => ['required', 'unique:agents'],
                        ]);
                    }
                }

                if ($MdpRetVal) {
                    $agent = Agent::find($id);
                    if ($agent->mdp === $request['current_mdp']) {
                        $request->validate([
                            'mdp' => ['required', 'min:8', 'same:mdp2'],
                        ]);
                    }else{
                        return redirect()->back()->withErrors('1');
                    }
                }

                if ($UsernameRetVal) {
                    if (strtolower($request['username']) !== strtolower(Agent::find($id)->username)) {
                        $return = Agent::find($id)->update([
                            'username' => valid_donnees(strtolower($request['username'])),
                        ]);
                    }
                }

                if ($MdpRetVal) {
                    $return = Agent::find($id)->update([
                        'mdp' => valid_donnees(strtolower($request['mdp'])),
                    ]);
                }

                if (!isset($return)) {
                    $return = false;
                }

                if ($return) {
                    $message = "Les modifications apporté ont été enregistré avec success";
                    return redirect()->back()->with('success', $message);
                }else{
                    return redirect()->back();
                }
            } else if(intval($request['form']) === 3){
                $id = valid_donnees($request['id']);

                $UsernameRetVal = (isset($request->username) && !empty($request->username)) ? 1 : 0 ;
                $MdpRetVal = (isset($request->mdp) && !empty($request->mdp) && isset($request->mdp2) && !empty($request->mdp2)) ? 1 : 0 ;

                $request->validate([
                    'nom' => ['required', 'between:1,30'],
                    'prenom' => ['required', 'between:1,30'],
                    'tel' => ['required','numeric'],
                    'sexe' => ['required', 'between:1,2'],
                    'date_naissance' => ['required', 'before:01-01-2010'],
                    'lieu_naissance' => ['required', 'between:1,125'],
                    'id_service' => ['required', 'numeric', 'min:1'],
                    'id_fonction' => ['required','numeric', 'min:1'],
                    'adresse' => ['nullable', 'max:255'],
                    'email' => ['required', 'email'],
                    'admins' => ['required', 'boolean']
                ]);

                if ($UsernameRetVal) {
                    if (strtolower($request['username']) !== strtolower(Agent::find($id)->username)) {
                        $request->validate([
                            'username' => ['required', 'unique:agents'],
                        ]);
                    }
                }

                if ($MdpRetVal) {
                    $request->validate([
                        'mdp' => ['required', 'min:8', 'same:mdp2'],
                    ]);
                }

                $return = Agent::find($id)->update([
                    'nom' => trim(breakPhrase(valid_donnees($request['nom']))),
                    'prenom' => trim(breakPhrase(valid_donnees($request['prenom']))),
                    'tel' => valid_donnees($request['tel']),
                    'sexe' => intval(valid_donnees($request['sexe'])),
                    'date_naissance' => valid_donnees($request['date_naissance']),
                    'lieu_naissance' => trim(breakPhrase(valid_donnees($request['lieu_naissance']))),
                    'id_fonction' => intval(valid_donnees($request['id_fonction'])),
                    'id_service' => intval(valid_donnees($request['id_service'])),
                    'adresse' => trim(breakPhrase(valid_donnees($request['adresse']))),
                    'email' => valid_donnees(strtolower($request['email'])),
                    'admins' => intval(valid_donnees($request['admins'])),
                ]);

                if ($UsernameRetVal) {
                    if (strtolower($request['username']) !== strtolower(Agent::find($id)->username)) {
                        $return = Agent::find($id)->update([
                            'username' => valid_donnees(strtolower($request['username'])),
                        ]);
                    }
                }

                if ($MdpRetVal) {
                    $return = Agent::find($id)->update([
                        'mdp' => valid_donnees($request['mdp']),
                    ]);
                }

                if (!isset($return)) {
                    $return = false;
                }

                if ($return) {
                    $message = "Les informations de l'employé ".trim(breakPhrase(valid_donnees($request['nom'])))." ".trim(breakPhrase(valid_donnees($request['prenom'])))." ont été modifié avec success";
                    return redirect()->back()->with('success', $message);
                }else{
                    return redirect()->back();
                }
            } else {
                return redirect()->back();
            }
        } else {
            return redirect('/connexion');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = null)
    {
        if (isset($_SESSION["id"]) && !empty($_SESSION["id"])){
            $agent = Agent::find(intval(valid_donnees($_GET['id'])));
            $message = "L'employé ".$agent->nom." ".$agent->prenom."à été supprimer avec succès";

            Agent::destroy(intval(valid_donnees($_GET['id'])));

            $qr_filename = "/qrcodes/$agent->id.svg";
            if (file_exists("../public$qr_filename")) {
                unlink("../public$qr_filename");
            }
            if (intval($agent->id) === intval($_SESSION["id"])) {
                unset($_SESSION["id"]);
                unset($_SESSION['admins']);
            }

            return redirect()->back()->with('success', $message);
        }else {
            return redirect('/connexion');
        }
    }
}
