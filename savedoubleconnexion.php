<?php

    include 'entete.html';

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BiblioTECH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .actualité-bar {
            background-color: #e0e0e0;
            font-size: 1.8rem;
            font-weight: bold;
            padding: 10px;
        }
        .login-box {
            background-color: #3a3a3a;
            color: white;
            padding: 20px;
            border-radius: 5px;
        }
        .login-box input {
            margin-bottom: 10px;
        }
        .book-img {
            max-height: 350px;
            object-fit: cover;
            margin: auto;
        }
    </style>
</head>
<body>

<!-- BARRE D'ACTUALITÉ -->
<div class="actualité-bar text-center">
    Espace membre 🛡️ : Vous devez être membre pour pouvoir réserver des livres
</div>
    <table style="width:100%" border="5px solid black" >
          <tr>
            <th>
   <!-- LOGIN gauche -->
        <div class="col-md-4" >
            <img src=pictures/Château_de_Moulinsart.jpg class="img-fluid mb-3" alt="Image gauche">
            <div class="login-box" style="background-color:DodgerBlue;">
                <h4 class="text-center">Se connecter</h4>
                <label>Identifiant</label>
                <input type="text" class="form-control" placeholder="Votre identifiant">

                <label>Mot de passe</label>
                <input type="password" class="form-control" placeholder="Votre mot de passe">

                <button class="btn btn-light w-100 mt-3">Connexion</button>
            </div>
        </div>

    </div>
         </th>
         <th>
 <!-- LOGIN DROITE -->
     <div class="col-md-4">
            <img src=pictures/Château_de_Moulinsart.jpg class="img-fluid mb-3" alt="Image droite">
       
            <div class="login-box" style="background-color:Tomato;">
                <h4 class="text-center">Admin</h4>
                <label>Identifiant</label>
                <input type="text" class="form-control" placeholder="Votre identifiant">

                <label>Mot de passe</label>
                <input type="password" class="form-control" placeholder="Votre mot de passe">

                <button class="btn btn-light w-100 mt-3">Connexion</button>
            </div>
        </div>

    </div>
    </th>
    </tr>
    </table>

       


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
