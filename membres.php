<?php
session_start(); // Toujours en premier pour gérer la session

try {
    $pdo = new PDO("mysql:host=localhost;dbname=bibliotech;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

$erreur = "";

// Traitement connexion uniquement si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["mel"], $_POST["motdepasse"])) {
    $mel = $_POST["mel"];
    $motdepasse = $_POST["motdepasse"];

    $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE mel = :mel AND motdepasse = :motdepasse");
    $stmt->execute([
        "mel" => $mel,
        "motdepasse" => $motdepasse
    ]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION["user"] = $user; // Stocke toutes les infos de l'utilisateur

        // Redirection selon le profil
        if ($user["profil"] === "admin") {
            header("Location: admin.php");
        } else {
            header("Location: espace_client.php");
        }
        exit; // Très important pour que le script s'arrête après la redirection
    } else {
        $erreur = "Identifiant ou mot de passe incorrect.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BiblioTECH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .actualité-bar { background-color: #e0e0e0; font-size: 1.8rem; font-weight: bold; padding: 10px; }
        .login-box { background-color: MediumSeaGreen; color: white; padding: 20px; border-radius: 5px; }
        .login-box input { margin-bottom: 10px; }
        .background { background-image: url('pictures/background7.gif'); height: 100vh; background-size: cover; background-position: center; }
    </style>
</head>
<body class="background">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
    <a class="navbar-brand" href="index.php"><img src=pictures/logo-biblioTECH.png alt="Logo" height="40"> BiblioTECH</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link" href="livres.php">Nos Livres</a></li>
            <li class="nav-item"><a class="nav-link" href="membres.php">Espace Membre</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Infos</a></li>
        </ul>
    </div>
</nav>

<div class="actualité-bar text-center">Espace membre 🛡️ : Vous devez être membre pour pouvoir réserver des livres</div>

<center>
    <div class="col-md-4 mt-5">
        <div class="login-box">
            <h4 class="text-center">Se connecter</h4>

            <?php if($erreur): ?>
                <div class="alert alert-danger"><?= $erreur ?></div>
            <?php endif; ?>

            <form method="POST" action="">
                <label>Identifiant (email)</label>
                <input type="email" name="mel" class="form-control" placeholder="Votre identifiant" required>

                <label>Mot de passe</label>
                <input type="password" name="motdepasse" class="form-control" placeholder="Votre mot de passe" required>

                <button type="submit" class="btn btn-light w-100 mt-3">Connexion</button>
            </form>
        </div>
    </div>
</center>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
