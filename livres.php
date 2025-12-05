<?php

    include 'entete.html';

?>

<?php
// Connexion BDD
$pdo = new PDO("mysql:host=localhost;dbname=bibliotech;charset=utf8", "root", "");

// Si une recherche est envoyée
$search = isset($_GET["search"]) ? trim($_GET["search"]) : "";

$search = isset($_GET['q']) ? trim($_GET['q']) : "";

if ($search != "") {
    $stmt = $pdo->prepare("
        SELECT * FROM livre 
        WHERE titre LIKE :search 
        OR detail LIKE :search
    ");
    $stmt->execute(["search" => "%".$search."%"]);
} else {
    $stmt = $pdo->query("SELECT * FROM livre ORDER BY titre");
}

$livres = $stmt->fetchAll(PDO::FETCH_ASSOC);

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


<div class="container">
<div class="actualité-bar text-center">
   <h2>  Trouver tout vos livres favoris ici 📕 </h2>
</div>

    <!-- BARRE DE RECHERCHE -->
    <form method="GET" class="mb-4">
    <input type="text" name="q" class="form-control"
           placeholder="Rechercher un livre..."
           value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>">
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
