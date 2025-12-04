<?php
// Connexion BDD
$pdo = new PDO("mysql:host=localhost;dbname=bibliotech;charset=utf8", "root", "");

// Si une recherche est envoyée
$search = isset($_GET["search"]) ? trim($_GET["search"]) : "";

// Requête SQL
if ($search !== "") {
    $sql = "SELECT livre.*, auteur.nom, auteur.prenom 
            FROM livre 
            INNER JOIN auteur ON livre.noauteur = auteur.noauteur
            WHERE auteur.nom LIKE :recherche";
    $req = $pdo->prepare($sql);
    $req->execute(["recherche" => "%$search%"]);
} else {
    // Par défaut : afficher tous les livres
    $sql = "SELECT livre.*, auteur.nom, auteur.prenom 
            FROM livre 
            INNER JOIN auteur ON livre.noauteur = auteur.noauteur";
    $req = $pdo->query($sql);
}

$livres = $req->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Recherche – BiblioTECH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .book-img {
            height: 250px;
            object-fit: cover;
        }
    </style>
</head>
<body class="bg-light">

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

        <a href="panier.php" class="btn btn-light fw-bold">Panier</a>
    </div>
</nav>

<div class="container">
<div class="actualité-bar text-center">
   <h2>  Trouver tout vos livres favoris ici 📕 </h2>
</div>

    <!-- BARRE DE RECHERCHE -->
    <form method="GET" class="input-group mb-4">
        <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" 
               placeholder="Tapez un nom d'auteur…" class="form-control">
        <button class="btn btn-primary" type="submit">Rechercher</button>
    </form>

    <!-- RÉSULTATS -->
    <div class="row">
        <?php if (count($livres) === 0): ?>
            <p class="text-muted">Aucun résultat pour : <strong><?= htmlspecialchars($search) ?></strong></p>
        <?php else: ?>

            <?php foreach ($livres as $livre): ?>
                <div class="col-md-3 mb-4">
                    <div class="card shadow-sm">
                        <img src="covers/<?= $livre['photo'] ?>" class="card-img-top book-img" alt="">
                        <div class="card-body">
                            <h5 class="card-title"><?= $livre['titre'] ?></h5>
                            <p class="card-text"><small class="text-muted">
                                <?= $livre['nom'] . " " . $livre['prenom'] ?>
                            </small></p>
                            <button class="btn btn-outline-primary w-100"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modal<?= $livre['nolivre'] ?>">
                                Voir détails
                            </button>
                        </div>
                    </div>
                </div>

                <!-- MODAL -->
                <div class="modal fade" id="modal<?= $livre['nolivre'] ?>" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h4 class="modal-title"><?= $livre['titre'] ?></h4>
                                <button class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body row">
                                <div class="col-md-4">
                                    <img src="covers/<?= $livre['photo'] ?>" class="img-fluid rounded">
                                </div>
                                <div class="col-md-8">
                                    <h5>Auteur : <?= $livre['nom'] . " " . $livre['prenom'] ?></h5>
                                    <p><strong>Année de parution :</strong> <?= $livre['anneeparution'] ?></p>

                                    <h6>Résumé :</h6>
                                    <p><?= nl2br($livre['detail']) ?></p>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <a href="emprunter.php?id=<?= $livre['nolivre'] ?>"
                                   class="btn btn-success">Emprunter</a>
                                <button class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            </div>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        <?php endif; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
