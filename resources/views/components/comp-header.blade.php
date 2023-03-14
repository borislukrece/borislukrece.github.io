<?php 
    use App\Models\Agent;
    use App\Models\Pointage;

    $id_conneted = $_SESSION['id'];

    $agentConnected = Agent::find($id_conneted);

    date_default_timezone_set('UTC');
    $now = time();
    $date = date('Y-m-d', $now);

    $verification = Pointage::where('date_actuelle', $date);
?>
<div style="width: 100%; height: 8vh; background: #D4D3DCB9;box-shadow: 0 4px 2px -2px rgba(0, 0, 0, 0.611);">
    <div style="
        height: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
    ">
        <div style="font-size: 1.2rem;padding-left: 1rem;font-weight: bold">
            Bienvenue @php
                $nomComplet = $agentConnected->nom.' '.$agentConnected->prenom;
                echo strtoupper($nomComplet);
            @endphp
        </div>
        <div style="display: flex;">
            <?php
                if (isset($_SESSION["id"]) && !empty($_SESSION["id"])) {
                    // Connected
                    $retAdmins = Agent::find(intval($_SESSION['id']));
                    $retAdmins = $retAdmins->admins;
                }else{
                    $retAdmins = false;
                }
            ?>
            @if ($retAdmins)
                @if (!$verification->exists())
                    <a href="/nouvelle-journee" class="btn btn-nouvelle-journee btn-nj" style="background: black;color: white;font-weight: bold;margin-right: 1rem;">Nouvelle Journée</a>
                    <a href="/nouvelle-journee" class="btn-nj" style="display: flex;align-items: center;justify-content: center; margin-right: 4rem;">
                        <i class="bi bi-toggle2-off" style="font-size: 2rem;color: black;display: flex;align-items: center;justify-content: center;"></i>
                    </a>
                @else
                    <div class="btn" style="background: green;font-weight: bold;margin-right: 1rem;cursor:default;">Nouvelle Journée</div>
                    <div style="display: flex;align-items: center;justify-content: center; margin-right: 4rem;">
                        <i class="bi bi-toggle2-on" style="font-size: 2rem;color: green;display: flex;align-items: center;justify-content: center;"></i>
                    </div>
                @endif
            @endif
            <div class="dropdown" data-toggle="tooltip" title="Administrateur" style="
                padding-right: 2vw;
                display: flex;
                align-items: center;
                position: relative;
            ">
                <button  class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" style="margin-right: 6px" fill="#EC9628" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                    </svg>
                    @php
                        $nomComplet = $agentConnected->nom.' '.$agentConnected->prenom;
                        echo strtoupper($nomComplet);
                    @endphp
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="margin-top: 0.5rem;">
                    {{-- <a class="dropdown-item" href="{{ url('menu/profil') }}" data-toggle="tooltip" title="Mon profil" style="
                        display: flex;
                        align-items: center;
                    ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" style="margin-right: 6px" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                        </svg>
                        Profil
                    </a> --}}
                    <a class="dropdown-item" href="/logout" data-toggle="tooltip" title="Se deconnecter" style="
                        display: flex;
                        align-items: center;
                        color: #ED2525;
                    ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" style="margin-right: 6px" fill="currentColor" class="bi bi-door-closed-fill" viewBox="0 0 16 16">
                            <path d="M12 1a1 1 0 0 1 1 1v13h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V2a1 1 0 0 1 1-1h8zm-2 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                        </svg>
                        Se deconnecter
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>