<?php
//On se connecte à la BDD
$bdd = new PDO(
'mysql:host=localhost;
dbname=id16313957_portfolio;
charset=utf8', 'id16313957_chelo', '2001Ahotyboris_');

$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>