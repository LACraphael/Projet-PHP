<?php

    include 'entete.html';

?>

<?php
session_start();

// Vérifie si l'utilisateur est connecté et est admin
if (!isset($_SESSION["user"]) || $_SESSION["user"]["profil"] !== "admin") {
    // Non autorisé → retour à la page membre
    header("Location: membres.php?error=Accès refusé");
    exit;
}

$user = $_SESSION["user"];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin BiblioTECH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h2>Bonjour <?= htmlspecialchars($user["prenom"]) ?>, bienvenue dans l'espace admin</h2>

    <div class="mt-4">
        <a href="admin_ajouter_livre.php" class="btn btn-primary mb-2">Ajouter un livre</a>
        <a href="admin_ajouter_user.php" class="btn btn-secondary mb-2">Ajouter un utilisateur</a>
        <a href="logout.php" class="btn btn-danger mb-2">Se déconnecter</a>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
