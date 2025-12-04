<?php
session_start();
if (!isset($_SESSION["user"]) || $_SESSION["user"]["profil"] !== "admin") {
    header("Location: membres.php");
    exit;
}

$pdo = new PDO("mysql:host=localhost;dbname=bibliotech;charset=utf8", "root", "");

// Traitement formulaire
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mel = $_POST["mel"];
    $motdepasse = $_POST["motdepasse"];
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $adresse = $_POST["adresse"];
    $ville = $_POST["ville"];
    $codepostal = $_POST["codepostal"];
    $profil = $_POST["profil"];

    $stmt = $pdo->prepare("INSERT INTO utilisateur (mel, motdepasse, nom, prenom, adresse, ville, codepostal, profil) 
                           VALUES (:mel, :motdepasse, :nom, :prenom, :adresse, :ville, :codepostal, :profil)");
    $stmt->execute([
        "mel" => $mel,
        "motdepasse" => $motdepasse,
        "nom" => $nom,
        "prenom" => $prenom,
        "adresse" => $adresse,
        "ville" => $ville,
        "codepostal" => $codepostal,
        "profil" => $profil
    ]);

    $success = "Utilisateur ajouté avec succès !";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un utilisateur – Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">

    <h2>Ajouter un utilisateur</h2>
    <a href="admin.php" class="btn btn-secondary mb-3">⬅ Retour</a>

    <?php if (isset($success)): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="mel" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Mot de passe</label>
            <input type="text" name="motdepasse" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Nom</label>
            <input type="text" name="nom" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Prénom</label>
            <input type="text" name="prenom" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Adresse</label>
            <input type="text" name="adresse" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Ville</label>
            <input type="text" name="ville" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Code postal</label>
            <input type="number" name="codepostal" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Profil</label>
            <select name="profil" class="form-control" required>
                <option value="">Sélectionnez un profil</option>
                <option value="client">Client</option>
                <option value="admin">Admin</option>
            </select>
        </div>

        <button class="btn btn-primary">Ajouter l'utilisateur</button>
    </form>
</div>
</body>
</html>
