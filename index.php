<?php

    include 'entete.php';

?>


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
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>

<!-- BARRE D'ACTUALITÉ -->
<div class="actualite-bar text-center">
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

        <h3 class="container">▲ Dernière arrivées ▲</h3>
        <p>Disponible dès maintenant en librairie</p>
    </div>
</div>
        
        <!-- IMAGE -->
        <div class="col-md-3">
            <img src=pictures/Château_de_Moulinsart.jpg class="img-fluid mb-3" alt="Image droite">
        <!-- LOGIN DROITE -->
                <?php if (!isset($_SESSION["user"])): ?>

<div class="login-box">
                <h4 class="text-center">Se connecter</h4>

                <form method="POST" action="login.php">
                    <input type="hidden" name="from_index" value="1">

                    <label>Email</label>
                    <input type="email" name="mel" class="form-control" required>

                    <label>Mot de passe</label>
                    <input type="password" name="motdepasse" class="form-control" required>

                    <button class="btn btn-light w-100 mt-3">Connexion</button>
                </form>
            </div>

            <?php else: ?>

            <div class="login-box">
                <h5>👋 Bonjour <?= htmlspecialchars($_SESSION["user"]["prenom"]) ?></h5>
                <ul class="list-unstyled">
                    <li><strong>Nom :</strong> <?= $_SESSION["user"]["nom"] ?></li>
                    <li><strong>Email :</strong> <?= $_SESSION["user"]["mel"] ?></li>
                    <li><strong>Adresse :</strong> <?= $_SESSION["user"]["adresse"] ?></li>
                </ul>

                <a href="membres.php" class="btn btn-success w-100">Mon espace</a>
            </div>

            <?php endif; ?>

            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>