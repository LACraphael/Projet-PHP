<?php
session_start();

$pdo = new PDO("mysql:host=localhost;dbname=bibliotech;charset=utf8", "root", "");

$mel = $_POST["mel"];
$mdp = $_POST["motdepasse"];

$sql = "SELECT * FROM utilisateur WHERE mel = :mel AND motdepasse = :mdp";
$req = $pdo->prepare($sql);
$req->execute(["mel" => $mel, "mdp" => $mdp]);

$user = $req->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    header("Location: membres.php?error=Identifiants incorrects");
    exit;
}

// Enregistrer session utilisateur
$_SESSION["user"] = $user;

// Redirection selon type de compte
if ($user["profil"] === "admin") {
    header("Location: admin.php");
    exit;
} else {
    header("Location: client.php");
    exit;
}
