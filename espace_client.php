<?php

    include 'entete.html';

?>

<?php
session_start();
if (!isset($_SESSION["user"]) || $_SESSION["user"]["profil"] !== "client") {
    header("Location: membres.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Client</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
</body>
</html>
<div class="col-md-3">
            <img src=pictures/Bienvenue.gif class="img-fluid mb-3" alt="Image droite">
<h2>Bienvenue <?= htmlspecialchars($_SESSION["user"]["prenom"]) ?></h2>
<p>Vous pouvez dès maintenant réserver vos livres sur le site .</p>
