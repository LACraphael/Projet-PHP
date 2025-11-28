<?php
// index.php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BiblioTECH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .actualité-bar {
            background-color: #e0e0e0;
            font-size: 1.8rem;
            font-weight: bold;
            padding: 10px;
        }
        .login-box {
            background-color: #3a3a3a;
            color: white;
            padding: 20px;
            border-radius: 5px;
        }
        .login-box input {
            margin-bottom: 10px;
        }
        .book-img {
            max-height: 350px;
            object-fit: cover;
            margin: auto;
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
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

        <a href="#" class="btn btn-light fw-bold">Panier</a>
    </div>
</nav>

<!-- BARRE D'ACTUALITÉ -->
<div class="actualité-bar text-center">
     Bienvennue dans votre panier 🛒 : Pas plus de 5 emprunt simultané
</div>



    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
