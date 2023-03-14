<?php
$full_name = valid_donnees($_POST["full_name"]);
$email = valid_donnees($_POST["email"]);
$subject = valid_donnees($_POST["subject"]);
$message = valid_donnees($_POST["message"]);

function valid_donnees($donnees){
    $donnees = trim($donnees);
    $donnees = stripslashes($donnees);
    $donnees = htmlspecialchars($donnees);
    return $donnees;
}

// Validation des données du formulaire
if (!empty($full_name)) {
    if (!empty($email)) {
        if (!empty($subject)) {
            if (!empty($message)) {
                // Configuration des paramètres d'envoi de l'e-mail
                $name = $full_name;
                $email = $email;
                $subject = $subject;
                $message = $message;
                $to = "ahotyboris.ab@gmail.com"; // Enter your email address here
                $headers = "From: ".$email."\r\n"."Reply-To: ".$email."\r\n";
                $txt = "You have received an email from ".$name.".\n\n".$message;
                
                if(mail($to,$subject,$txt,$headers)) {
                    // Email sent successfully!
                    header('Location: /contact.php?success=true');
                } else {
                    // Email not sent;
                    header('Location: /contact.php?error=5');
                }
            }else{
                //Entrer votre Message
                header('Location: /contact.php?error=4');
            }
        }else{
            //Entrer votre Sujet
            header('Location: /contact.php?error=3');
        }
    }else{
        //Entrer votre Email
        header('Location: /contact.php?error=2');
    }
}else{
    //Entrer votre Nom
    header('Location: /contact.php?error=1');
}

// echo $full_name."---".$email."----".$subject."----".$message;
?>