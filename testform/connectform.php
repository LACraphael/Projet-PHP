<?php

// Connexion au serveur

try {

  $bdd = 'mysql:host=localhost;dbname=User_db'; // dbname : nom de la base
  $utilisateur = 'root'; // root sur vos postes
  $motDePasse = ''; // pas de mot de passe sur vos postes
  $connexion = new PDO( $bdd, $utilisateur, $motDePasse );
  echo "Connexion à MySQL réussi : ";

} catch (Exception $e) {
  echo "Connexion à MySQL impossible : ", $e->getMessage();

  die();

}

?>