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
<!-- BARRE DE RECHERCHE -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
    <a class="navbar-brand" href="index.php">
        <img src=pictures/logo-biblioTECH.png alt="Logo" height="40"> BiblioTECH
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link" href="livres.php">Nos Livres</a></li>
            <li class="nav-item"><a class="nav-link" href="membres.php">Espace Membre</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Infos</a></li>
        </ul>

        <form class="d-flex me-3" role="search">
            <input class="form-control me-2" type="search" placeholder="Taper votre texte ici">
            <button class="btn btn-primary" type="submit">Recherche</button>
        </form>

        <a href="panier.php" class="btn btn-light fw-bold">Panier</a>
    </div>
</nav>

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
