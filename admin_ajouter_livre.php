<?php
session_start();
if (!isset($_SESSION["user"]) || $_SESSION["user"]["profil"] !== "admin") {
    header("Location: membres.php");
    exit;
}

$pdo = new PDO("mysql:host=localhost;dbname=bibliotech;charset=utf8", "root", "");

// 
$auteurs = $pdo->query("SELECT noauteur, CONCAT(prenom,' ',nom) AS nom_complet FROM auteur ORDER BY nom")->fetchAll(PDO::FETCH_ASSOC);

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $titre = $_POST["titre"];
    $noauteur = $_POST["noauteur"];
    $isbn13 = $_POST["isbn13"];
    $anneeparution = $_POST["anneeparution"];
    $detail = $_POST["detail"];
    $dateajout = date("Y-m-d");

    // Vérifier si on ajoute un nouvel auteur
    if (!empty($_POST["nouvel_auteur_prenom"]) && !empty($_POST["nouvel_auteur_nom"])) {
        $stmt = $pdo->prepare("INSERT INTO auteur (prenom, nom) VALUES (:prenom, :nom)");
        $stmt->execute([
            "prenom" => $_POST["nouvel_auteur_prenom"],
            "nom" => $_POST["nouvel_auteur_nom"]
        ]);
        $noauteur = $pdo->lastInsertId(); // On récupère l'ID du nouvel auteur
    }

    // Gestion upload image
    $photo = null;
    if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] === 0) {
        $ext = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
        $photo = uniqid() . "." . $ext;
        move_uploaded_file($_FILES["photo"]["tmp_name"], "covers/" . $photo);
    }

    // Insertion livre
    $stmt = $pdo->prepare("INSERT INTO livre (noauteur, titre, isbn13, anneeparution, detail, dateajout, photo) 
                           VALUES (:noauteur, :titre, :isbn13, :anneeparution, :detail, :dateajout, :photo)");
    $stmt->execute([
        "noauteur" => $noauteur,
        "titre" => $titre,
        "isbn13" => $isbn13,
        "anneeparution" => $anneeparution,
        "detail" => $detail,
        "dateajout" => $dateajout,
        "photo" => $photo
    ]);

    $success = "Livre ajouté avec succès !";
}
?> 

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un livre – Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-4">

    <h2>Ajouter un livre</h2>
    <a href="admin.php" class="btn btn-secondary mb-3">⬅ Retour</a>

    <?php if (isset($success)): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Titre</label>
            <input type="text" name="titre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Auteur</label>
            <select name="noauteur" class="form-control">
                <option value="">Sélectionnez un auteur</option>
                <?php foreach($auteurs as $a): ?>
                    <option value="<?= $a["noauteur"] ?>"><?= htmlspecialchars($a["nom_complet"]) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
    <label>Ou ajouter un nouvel auteur :</label>
    <div class="row">
        <div class="col">
            <input type="text" name="nouvel_auteur_prenom" class="form-control" placeholder="Prénom">
        </div>
        <div class="col">
            <input type="text" name="nouvel_auteur_nom" class="form-control" placeholder="Nom">
        </div>
    </div>
    <small class="text-muted">Si vous remplissez ces champs, ils seront utilisés pour créer un nouvel auteur.</small>
</div>



        <div class="mb-3">
            <label>ISBN13</label>
            <input type="text" name="isbn13" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Année de parution</label>
            <input type="number" name="anneeparution" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Résumé</label>
            <textarea name="detail" class="form-control" rows="5" required></textarea>
        </div>

        <div class="mb-3">
            <label>Photo du livre</label>
            <input type="file" name="photo" class="form-control">
        </div>

        <button class="btn btn-primary">Ajouter le livre</button>
    </form>
</div>
</body>
</html>
