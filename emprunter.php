<?php
session_start();

// Vérifier ID livre
if (!isset($_GET['id'])) {
    header("Location: livres.php");
    exit;
}

$idLivre = (int) $_GET['id'];

// Initialisation panier
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

// Limite 5 livres
if (count($_SESSION['panier']) >= 5) {
    $_SESSION['erreur'] = "Maximum 5 livres autorisés.";
    header("Location: livres.php");
    exit;
}

// ✅ Ajouter au panier
$_SESSION['panier'][$idLivre] = true;

// ✅ RESTER SUR livres.php
header("Location: livres.php");
exit;
