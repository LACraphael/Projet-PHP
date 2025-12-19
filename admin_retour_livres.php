<?php
include 'entete.php';

// Sécurité admin
if (!isset($_SESSION['user']) || $_SESSION['user']['profil'] !== 'admin') {
    header("Location: membres.php");
    exit;
}

if (!isset($_GET['nolivre'])) {
    header("Location: admin.php");
    exit;
}

$pdo = new PDO("mysql:host=localhost;dbname=bibliotech;charset=utf8", "root", "");

$nolivre = (int) $_GET['nolivre'];

// Marquer le retour
$pdo->prepare("
    UPDATE emprunter
    SET dateretour = CURDATE()
    WHERE nolivre = ? AND dateretour IS NULL
")->execute([$nolivre]);

// Rendre le livre disponible
$pdo->prepare("
    UPDATE livre SET disponible = 1 WHERE nolivre = ?
")->execute([$nolivre]);

header("Location: admin.php");
exit;
