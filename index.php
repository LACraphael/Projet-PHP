<?php
// index.php
// chemin des covers : 

$pdo = new PDO("mysql:host=localhost;dbname=bibliotech;charset=utf8", "root", "");

$requete = $pdo->query("
    SELECT photo AS image, titre 
    FROM livre 
    ORDER BY dateajout DESC 
    LIMIT 3
");

$livres = $requete->fetchAll(PDO::FETCH_ASSOC);
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

<!-- BARRE D'ACTUALITÉ -->
<div class="actualité-bar text-center">
    Actualité 📰 : La bibliothèque sera fermer jusque au 18 décembre
</div>

<!-- CONTENU PRINCIPAL -->
<div class="container-fluid mt-4">
    <div class="row">

        <!-- IMAGE GAUCHE -->
        <div class="col-md-3 text-center">
            <img src=pictures/tintinpng.png alt="Illustration" class="img-fluid w-100" style="height:145%; object-fit:cover;">
        </div>

        <!-- CARROUSEL CENTRAL -->
<div class="col-md-6 d-flex justify-content-center" style="max-height: 180px;">
    <div class="carousel-container">
        <div id="carouselLivres" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">

                <?php
                $active = "active";
                foreach ($livres as $livre) {
                    echo '
                    <div class="carousel-item ' . $active . '">
                        <img src="covers/' . $livre["image"] . '" class="d-block book-img" alt="' . $livre["titre"] . '">
                    </div>';
                    $active = "";
                }
                ?>

            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselLivres" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselLivres" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>

        <h3 class="mt-3">▲ Dernière arrivées ▲</h3>
        <p>Disponible dès maintenant en librairie</p>
    </div>
</div>
        
        <!-- IMAGE -->
        <div class="col-md-3">
            <img src=pictures/Château_de_Moulinsart.jpg class="img-fluid mb-3" alt="Image droite">
        <!-- LOGIN DROITE -->
            <div class="login-box">
                <h4 class="text-center">Se connecter</h4>
                <label>Identifiant</label>
                <input type="text" class="form-control" placeholder="Votre identifiant">

                <label>Mot de passe</label>
                <input type="password" class="form-control" placeholder="Votre mot de passe">

                <button class="btn btn-light w-100 mt-3">Connexion</button>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
