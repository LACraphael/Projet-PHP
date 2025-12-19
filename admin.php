<?php

    include 'entete.php';

?>

<?php

// Vérifie si l'utilisateur est connecté et est admin
if (!isset($_SESSION["user"]) || $_SESSION["user"]["profil"] !== "admin") {
    // Non autorisé → retour à la page membre
    header("Location: membres.php?error=Accès refusé");
    exit;
}

$user = $_SESSION["user"];
$pdo = new PDO("mysql:host=localhost;dbname=bibliotech;charset=utf8", "root", "");

// Emprunts en cours UNIQUEMENT
$stmt = $pdo->query("
    SELECT 
        e.nolivre,
        e.mel,
        e.dateemprunt,
        l.titre,
        u.nom,
        u.prenom
    FROM emprunter e
    INNER JOIN livre l ON e.nolivre = l.nolivre
    INNER JOIN utilisateur u ON e.mel = u.mel
    WHERE e.dateretour IS NULL
");

$emprunts = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

<div class="container mt-4">
    <h2>Bonjour <?= htmlspecialchars($user["prenom"]) ?>, bienvenue dans l'espace admin</h2>

    <div class="mt-4">
        <a href="admin_ajouter_livre.php" class="btn btn-primary mb-2">Ajouter un livre</a>
        <a href="admin_ajouter_user.php" class="btn btn-secondary mb-2">Ajouter un utilisateur</a>
        <a href="logout.php" class="btn btn-danger mb-2">Se déconnecter</a>
    </div>
</div>
<h3 class="mt-5">📋 Livres empruntés</h3>

<?php if (empty($emprunts)): ?>
    <p class="text-muted">Aucun livre n'est actuellement emprunté.</p>
<?php else: ?>
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Livre</th>
                <th>Emprunté par</th>
                <th>Date d’emprunt</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($emprunts as $e): ?>
                <tr>
                    <td><?= htmlspecialchars($e['titre']) ?></td>
                    <td><?= htmlspecialchars($e['prenom'] . " " . $e['nom']) ?></td>
                    <td><?= htmlspecialchars($e['dateemprunt']) ?></td>
                    <td>
                        <a href="admin_retour_livres.php?nolivre=<?= $e['nolivre'] ?>"
                           class="btn btn-success btn-sm"
                           onclick="return confirm('Confirmer le retour du livre ?')">
                            Livre rendu
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
