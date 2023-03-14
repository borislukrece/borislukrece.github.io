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

    $get_id = intval(valid_donnees($_GET['id']));

    $agent = Agent::find($get_id);

    $service = Service::all()->sortBy('id');
    $fonction = Fonction::all()->sortBy('id');
?>
<div style="width: 100%;height: 100%;">
    <input type="hidden" name="form" value="3">
    <input type="hidden" name="id" value="{{ $agent->id }}">
    <div style="
        width: 100%;
        height: 100%;
        background: white;
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
                        <div class="form-row" style="width: 100%;margin-top:1rem;display: flex;flex-direction: row;">
                            <div class="col-md-4">
                                <label for="nom">Nom</label>
                                <input type="nom" autocomplete="off" class="form-control" id="nom" name="nom" placeholder="Nom" value="<?php echo $agent->nom; ?>" required>
                            </div>
                            <div class="col-md-4" style="padding-left: 2rem;">
                                <label for="prenom">Prenom</label>
                                <input type="prenom" autocomplete="off" class="form-control" id="prenom" name="prenom" placeholder="Prenom" value="<?php echo $agent->prenom; ?>" required>
                            </div>
                            <div class="col-md-4" style="padding-left: 2rem;">
                                <label for="tel">Telephone</label>
                                <input type="tel" autocomplete="off" class="form-control" id="tel" name="tel" placeholder="Telephone" value="<?php echo $agent->tel; ?>" required>
                            </div>
                        </div>

                        <div class="form-row" style="width: 100%;margin-top:1rem;display: flex;flex-direction: row;">
                            <div class="col-md-4">
                                <label for="sexe">Sexe <span style="color: red;">*</span> </label>
                                <div class="form-group">
                                    <select class="form-select form-control" id="sexe" name="sexe" autocomplete="off" aria-label="Default select example" required>
                                        <?php
                                            if(!empty($agent->sexe)){
                                                $sexe = $agent->sexe;
                                            }else{
                                                $sexe = 0;
                                            }

                                            if ($sexe === 0) {
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
                            <div class="col-md-4" style="padding-left: 2rem;">
                                <label for="date_naissance">Date de naissance <span style="color: red;">*</span> </label>
                                <input type="date" class="form-control" id="date_naissance" name="date_naissance" autocomplete="off" placeholder="Date de naissance" value="<?php echo $agent->date_naissance; ?>" required>
                                @if ($errors->any())
                                    @foreach ($errors->get('date_naissance') as $message)
                                        <div class="feedback text-danger">{{ $message }}</div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="col-md-4" style="padding-left: 2rem;">
                                <label for="lieu_naissance">Lieu de naissance <span style="color: red;">*</span> </label>
                                <input type="text" class="form-control" id="lieu_naissance" name="lieu_naissance" autocomplete="off" placeholder="Lieu de Naissance" value="<?php echo $agent->lieu_naissance; ?>" required>
                                @if ($errors->any())
                                    @foreach ($errors->get('lieu_naissance') as $message)
                                        <div class="feedback text-danger">{{ $message }}</div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <div class="form-row" style="width: 100%;margin-top:1rem;display: flex;flex-direction: row;">
                            <div class="col-md-4">
                                <label for="fonction">Fonction</label>
                                <div class="form-group">
                                    <select class="form-select form-control" id="id_fonction" name="id_fonction" aria-label="Default select" required>
                                        <?php
                                            if(!empty($agent->id_fonction)){
                                                $input_fonction = intval($agent->id_fonction);
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
                            </div>
                            <div class="col-md-4" style="padding-left: 2rem;">
                                <label for="id_service">Service</label>
                                <div class="form-group">
                                    <select class="form-select form-control" id="id_service" name="id_service" aria-label="Default select" required>
                                        <?php
                                            if(!empty($agent->id_service)){
                                                $input_service = intval($agent->id_service);
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
                            </div>
                        </div>

                        <div class="form-row" style="width: 100%;margin-top:1rem;display: flex;flex-direction: row;">
                            <div class="col-md-4">
                                <label for="adresse">Adresse</label>
                                <input type="name" autocomplete="off" class="form-control" id="adresse" name="adresse" placeholder="adresse" value="<?php echo $agent->adresse; ?>">
                            </div>
                            <div class="col-md-4" style="padding-left: 2rem;">
                                <label for="email">Email</label>
                                <input type="email" autocomplete="off" class="form-control" id="email" name="email" value="<?php echo $agent->email; ?>" placeholder="Email" required>
                            </div>
                        </div>

                        <div class="form-row" style="width: 100%;margin-top:1rem;display: flex;flex-direction: row;">
                            <div class="col-md-4">
                                <label for="mdp">Nouveau mot de passe</label>
                                <input type="password" autocomplete="off" class="form-control" id="mdp" name="mdp" placeholder="Nouveau mot de passe">
                            </div>

                            <div class="col-md-6" style="padding-left: 2rem;">
                                <label for="mdp2">Confirmer le mot de passe</label>
                                <input type="password" autocomplete="off" class="form-control" id="mdp2" name="mdp2" placeholder="Confirmer le nouveau mot de passe">
                            </div>
                        </div>

                        <div class="form-row" style="width: 100%;margin-top:1rem;display: flex;flex-direction: row;">
                            <div class="col-md-4">
                                <label for="username">Nom d'utilisateur</label>
                                <input type="username" autocomplete="off" class="form-control" id="username" name="username" value="<?php echo $agent->username; ?>" placeholder="Nom d'utilisateur">
                            </div>
                            <div class="col-md-4" style="padding-left: 2rem;">
                                <label for="admins">Administrateur</label>
                                <div class="form-group">
                                    <select class="form-select form-control" id="admins" name="admins" aria-label="Default select example" required>
                                        <?php
                                            if(intval($agent->admins)){
                                                $input_admin = intval($agent->admins);
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
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>