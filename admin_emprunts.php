<?php
$pdo = new PDO("mysql:host=localhost;dbname=bibliotech;charset=utf8", "root", "");

// Récupérer les livres empruntés
$stmt = $pdo->query("
    SELECT 
        emprunter.nolivre,
        emprunter.mel,
        emprunter.dateemprunt,
        livre.titre,
        utilisateur.nom,
        utilisateur.prenom
    FROM emprunter
    INNER JOIN livre ON emprunter.nolivre = livre.nolivre
    INNER JOIN utilisateur ON emprunter.mel = utilisateur.mel
    WHERE livre.disponible = 0
");

$emprunts = $stmt->fetchAll(PDO::FETCH_ASSOC);
