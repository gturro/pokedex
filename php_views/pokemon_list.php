<?php 
session_start();
include_once "../php_librarys/bd.php";
$_SESSION["pokedex"] = selectAllPokemons();
if (isset($_SESSION["pokemon"])) { unset($_SESSION["pokemon"]); }
if (isset($_SESSION['editPokemon'])) { unset($_SESSION["editPokemon"]); }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style/style.css">
    <script src="https://kit.fontawesome.com/45d5fbd6ce.js" crossorigin="anonymous"></script>
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php include '../php_partials/menu.php' ?>
    <div class="container-fluid mt-2">
    <?php require_once "../php_partials/errors_check.php" ?>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 mx-3 g-4 justify-content-center">    
        <?php foreach ($_SESSION['pokedex'] as $pokemon) { ?>
                <div class='col'>
                    <div class='card h-100 border-secondary'>
                        <img class='card-img-top' src='<?php echo $pokemon['imagen'];?>' alt='pokemon_<?php echo $pokemon['numero'] ?>'>
                        <div class='card-body'>
                            <ul class='list-group list-group-flush'>
                                <li class='list-group-item'>
                                <?php echo $pokemon['numero']." - ".$pokemon['nombre'];?>
                                </li>
                                <li class='list-group-item'>
                                <?php 
                                foreach ($pokemon["tipos"] as $type) {
                                        echo "<span class='badge ".typeBadgeColor($type["nombre"])."'>".$type['nombre']."</span>";  
                                    } ?>
                                </li>
                            </ul>
                        </div>
                        <div class='card-footer'>
                            <form class='deletePokForm' action='../php_controller/pokemonController.php' method='post'>
                                <button class='btn btn-outline-danger' type='submit' name='deletePokemon'>
                                    <i class='fa-solid fa-trash-can'></i>
                                </button>
                                <input type='hidden' name='deletePokemonNum' value="<?php echo $pokemon['numero'] ?>">
                            </form>
                            <form class='editPokForm' action='../php_controller/pokemonController.php' method='post'>
                                <button class='btn btn-outline-primary' type='submit' name='editPokemon'>
                                    <i class='fa-solid fa-pen-to-square'></i>
                                </button>
                                <input type='hidden' name='editPokemonID' value="<?php echo $pokemon['id'] ?>">
                            </form>
                        </div>
                    </div>
                </div>
            <?php }?>
    </div>
    <a href="./pokemon_form.php">
        <button id='addPokBtn' class='btn btn-warning btn-outline-dark rounded-circle'>
            <i class="fa-solid fa-plus"></i>
        </button>
    </a>
</body>
</html>