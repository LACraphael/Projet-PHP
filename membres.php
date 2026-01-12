<?php
include 'entete.php';

if (isset($_SESSION["user"])) {
    if ($_SESSION["user"]["profil"] === "admin") {
        header("Location: admin.php");
    } else {
        header("Location: espace_client.php");
    }
    exit;
}

try {
    $pdo = new PDO("mysql:host=localhost;dbname=bibliotech;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

$erreur = "";


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
        $_SESSION["user"] = $user; //

        // Redirection selon le profil
        if ($user["profil"] === "admin") {
            header("Location: admin.php");
        } else {
            header("Location: espace_client.php");
        }
        exit; 
    } else {
        $erreur = "Identifiant ou mot de passe incorrect.";
    }
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BiblioTECH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="stylemembers.css"/>
</head>
<body class="background">

<div class="actualite-bar text-center">Espace membre 🛡️ : Vous devez être membre pour pouvoir réserver des livres</div>

<!-- ANCIEN CENTER -->
    <div class="col-md-4 mt-5"  class="centrer"   >
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


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
