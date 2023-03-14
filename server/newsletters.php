<?php
include("connexion.php");

$email = valid_donnees($_POST["email"]);
$email = strtolower($email);
    
function valid_donnees($donnees){
    $donnees = trim($donnees);
    $donnees = stripslashes($donnees);
    $donnees = htmlspecialchars($donnees);
    return $donnees;
}

$verif_email = $bdd->prepare("SELECT * FROM newsletters WHERE email = ?");
$verif_email->execute([$email]);
$exists = $verif_email->fetch();

if(!$exists){
    date_default_timezone_set('UTC');
    $now = time();
    $date = date('Y-m-d', $now);
    
    $date_created = $date;
    
    $req = $bdd->prepare('INSERT INTO newsletters (email, date_created) VALUES(?, ?)');
    $req->execute(array($email, $date_created));
    
   if(isset($_SERVER['HTTP_REFERER'])) {
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
      // Si le referer est introuvable, rediriger vers une page par défaut
      header('Location: index.php');
    }
}else{
    // Exixts
    // Rediriger l'utilisateur sur la page précédente
    if(isset($_SERVER['HTTP_REFERER'])) {
      header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else {
      // Si le referer est introuvable, rediriger vers une page par défaut
      header('Location: index.php');
    }
}
?>