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
    <script src="https://kit.fontawesome.com/45d5fbd6ce.js" crossorigin="anonymous"></script>
    <script src="./assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <?php include './php_librarys/pokedex_array.php'; ?>
    <title>My Pokedex</title>
</head>
<body>
<?php include './php_partials/menu.php';?>


<h1>MY POKEDEX</h1>
    <?php
    //var_dump($_SESSION["pokedex"]);//debugg

    //printPok("number", "004");

    //DEBUG
    /* modifyPokemon("name", "Charmander", "Charmeleon");
    modifyPokemon("height", 1000, 1);
    modifyPokemon("number", "004", "005");
    
    deletePokemon("number", 003);
    modifyPokemon("name","Caterpie", "Manuel");
    addPok(createPok("006", "Charizard", "Jotho", ["Fire", "Flying"], 170, 90.5, 2, "006"));
    modifyPokemon("img", "./media/004.png", "./media/005.png");
    deletePokemon("name", "Jose");
    modifyPokemon("number", 999, 045);
    //printPokedex(); 
    //echo "pok 002 index: " . findPokByNum("002");
    printLogEntries();
    
    printPokedex(); */
    ?>
</body>
</html>