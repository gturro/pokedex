<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style.css">
    <?php include "./php_librarys/pokedex_array.php" ?>
    <title>My Pokedex</title>
</head>
<body>

<h1>MY POKEDEX</h1>
    <?php


    //var_dump($_SESSION["pokedex"]);//debugg
    printPokedex();

    //printPok("number", "004");

    //DEBUG
    modPok("name", "Charmander", "Charmeleon");
    modPok("number", "004", "005");
    rmPok("number", 003);
    addPok(createPok("006", "Charizard", "Jotho", ["Fire", "Flying"], 170, 90.5, 2, "006"));
    modPok("img", "./media/004.png", "./media/005.png");
    rmPok("name", "Charmander");
    //printPokedex(); 
    //echo "pok 002 index: " . findPokByNum("002");
    printLogEntries();
    
    ?>
</body>
</html>