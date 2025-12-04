<?php

// Connexion au serveur

try {

  $dns = 'mysql:host=localhost;dbname=bibliotech'; // dbname : nom de la base
  $utilisateur = 'root'; // root sur vos postes
  $motDePasse = ''; // pas de mot de passe sur vos postes
  $connexion = new PDO( $dns, $utilisateur, $motDePasse );
  echo "Connexion à MySQL réussi : ";

} catch (Exception $e) {
  echo "Connexion à MySQL impossible : ", $e->getMessage();

  die();

}

?>

 