<?php
session_start();

try {
    $pdo = new PDO("mysql:host=localhost;dbname=bibliotech;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur BDD : " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $mel = $_POST["mel"];
    $motdepasse = $_POST["motdepasse"];

    $stmt = $pdo->prepare("
        SELECT * FROM utilisateur 
        WHERE mel = :mel AND motdepasse = :motdepasse
    ");
    $stmt->execute([
        "mel" => $mel,
        "motdepasse" => $motdepasse
    ]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $_SESSION["user"] = $user;

        // Redirection intelligente
        if (!empty($_POST["from_index"])) {
            header("Location: index.php");
        } else {
            header("Location: membres.php");
        }
        exit;
    }

    $_SESSION["erreur"] = "Identifiants incorrects";
    header("Location: membres.php");
    exit;
}
?> 