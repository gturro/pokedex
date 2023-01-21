<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./style/style.css">
    <style>
        html, body {
            height: 100vh;
            background-position: top;
        }
    </style>
    <script src="https://kit.fontawesome.com/45d5fbd6ce.js" crossorigin="anonymous"></script>
    <script src="./assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <?php include './php_librarys/bd.php'; ?>
    <title>My pokedex</title>
</head>
<body>
    <!-- nav -->
    <?php include './php_partials/menu.php'; ?>
    <div class="container-fluid mt-2">
    <?php require_once "./php_partials/errors_check.php"; ?>
    </div>
    
    <?php 
    //insertPokemon("123", "delorean", 123, 123, "not evolved", "pokedexPATTTHh", 2, ["Psíquico", "Volador", "Fuego"]);
    //deletePok(3);
    //selectID("002");
    //updatePokemon(01, "001", "ElCigala", 120, 400, "no evolution", 2, ["Agua", "Lucha", "Psíquico"], "")
    ?>
</body>
</html>