<?php
include 'entete.php';

$pdo = new PDO("mysql:host=localhost;dbname=bibliotech;charset=utf8", "root", "");

// Initialisation panier
$panier = $_SESSION['panier'] ?? [];

// Suppression d’un livre
if (isset($_GET['remove'])) {
    unset($_SESSION['panier'][$_GET['remove']]);
    header("Location: panier.php");
    exit;
}

// Validation du panier
if (isset($_POST['valider'])) {

    if (!isset($_SESSION['user'])) {
        $_SESSION['redirect_after_login'] = 'panier.php';
        header("Location: membres.php");
        exit;
    }

    foreach ($panier as $idLivre => $v) {
    // Vérifier si l'utilisateur a déjà emprunté ce livre aujourd'hui
    $check = $pdo->prepare("
        SELECT COUNT(*) FROM emprunter
        WHERE mel = ?
        AND nolivre = ?
        AND dateemprunt = CURDATE()
    ");
    $check->execute([
        $_SESSION['user']['mel'],
        $idLivre
    ]);

    if ($check->fetchColumn() > 0) {
        $message = "❌ Vous ne pouvez pas emprunter le même livre deux fois le même jour.";
        continue; // passe au livre suivant
    }

        // Enregistrer l’emprunt
        $stmt = $pdo->prepare("
            INSERT INTO emprunter (mel, nolivre, dateemprunt)
            VALUES (?, ?, CURDATE())
        ");
        $stmt->execute([
            $_SESSION['user']['mel'],
            $idLivre
        ]);

        // Marquer le livre indisponible
        $pdo->prepare("
            UPDATE livre SET disponible = 0
            WHERE nolivre = ?
        ")->execute([$idLivre]);
    }

    unset($_SESSION['panier']);
    $panier = [];
    $message = "Emprunt validé avec succès 🎉";
}

// Récupération des livres du panier
$livres = [];
if (!empty($panier)) {
    $ids = implode(',', array_keys($panier));
    $livres = $pdo->query("
        SELECT * FROM livre WHERE nolivre IN ($ids)
    ")->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>BiblioTECH – Panier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="stylemembers.css"/>
</head>
<body>

<div class="actualite-bar text-center">
    Bienvenue dans votre panier 🛒 (max 5 livres)
</div>

<div class="container mt-4">
    <h2>📚 Mon panier</h2>

    <?php if (isset($message)): ?>
        <div class="alert alert-success"><?= $message ?></div>
    <?php endif; ?>

    <?php if (empty($livres)): ?>
        <p class="text-muted">Votre panier est vide.</p>
    <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($livres as $livre): ?>
                    <tr>
                        <td><?= htmlspecialchars($livre['titre']) ?></td>
                        <td>
                            <a href="panier.php?remove=<?= $livre['nolivre'] ?>"
                               class="btn btn-danger btn-sm">
                                Retirer
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <form method="post">
            <button name="valider" class="btn btn-success">
                Valider l’emprunt
            </button>
        </form>
    <?php endif; ?>
</div>

</body>
</html>
