<?php
session_start();
if (!isset($_SESSION["user"]) || $_SESSION["user"]["profil"] !== "client") {
    header("Location: membres.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Client</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
</body>
</html>
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

<h2>Bienvenue <?= htmlspecialchars($_SESSION["user"]["prenom"]) ?></h2>
<p>Vous pouvez dès maintenant réserver vos livres sur le site .</p>
