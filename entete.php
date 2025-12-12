<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bibliotech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
    <a class="navbar-brand" href="index.php">
        <img src="pictures/logo-biblioTECH.png" alt="Logo" height="40"> BiblioTECH
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link" href="livres.php">Nos Livres</a></li>
            <li class="nav-item"><a class="nav-link" href="membres.php">Espace Membre</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Infos</a></li>

            <?php if (isset($_SESSION["user"])): ?>
                <img src="pictures/CONNECTpng.png" alt="Connecté" height="40">
            <?php else: ?>
                <img src="pictures/DISCONNECTpng.png" alt="Déconnecté" height="40">
            <?php endif; ?>
        </ul>

        <form class="d-flex me-3" role="search" action="livres.php" method="GET">
            <input class="form-control me-2" type="search" name="q" placeholder="Rechercher vos livres ici" required>
            <button class="btn btn-primary" type="submit">Recherche</button>
        </form>

        <a href="panier.php" class="btn btn-light fw-bold">Panier</a>

        <?php if (isset($_SESSION["user"])): ?>
            <a href="logout.php" class="btn btn-danger ms-3">Déconnexion</a>
        <?php endif; ?>
    </div>
</nav>
