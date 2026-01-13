<?php if(isset($_POST['ok'])){
$nom=$_POST['nom'];
$pseudo=$_POST['pseudo'];
$email=$_POST['email'];
$password=$_POST['password'];

$requete = connexion->prepare("INSERT INTO utilisateurs (pseudo, email, nom, mot_de_passe) VALUES (:pseudo, :email, :nom,   :mot_de_passe)"); 
$requete->execute(array(
    'pseudo' => $pseudo,
    'email' => $email,
    'nom' => $nom,
    'mot_de_passe' => $password
));
 $reponse = $requete->fetchAll(PDO: :FETCH_ASSOC);
}
?>