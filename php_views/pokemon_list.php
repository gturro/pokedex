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
    <?php include '../php_librarys/pokedex_array.php'; ?>
</head>
<body>
    <?php include'../php_partials/menu.php'?>
    
    <div class="container-fluid">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 mx-3 g-4">
                <?php 
                foreach ($_SESSION['pokedex'] as $pokemon) {
                echo
                "<div class='col'>
                    <div class='card h-100 border-secondary'>
                        <img class='card-img-top' src='".$pokemon['img']."' alt='pokemon image'>
                        <div class='card-body'>
                            <ul class='list-group list-group-flush'>
                                <li class='list-group-item'>"
                                .$pokemon['number']." - ".$pokemon['name'].
                                "</li>
                                <li class='list-group-item'>";
                                    foreach ($pokemon['type'] as $type) {
                                        echo "<span class='badge ".typeBadgeColor($type)."'>$type</span>";  
                                    } 
                        echo    "</li>
                            </ul>
                        </div>
                        <div class='card-footer'>
                            <form class='delatePokForm' action='/pokedex/php_controller/pokemonController.php' method='post'>
                                <button class='btn btn-outline-danger' type='submit' name='delatePokemon'>
                                    <i class='fa-solid fa-trash-can'></i>
                                </button>
                                <input type='hidden'>
                            </form>
                            <form class='editPokForm' action='/pokedex/php_controller/pokemonController.php' method='post'>
                                <button class='btn btn-outline-primary' type='submit' name='modifyPokemon'>
                                    <i class='fa-solid fa-pen-to-square'></i>
                                </button>
                                <input type='hidden'>
                            </form>
                        </div>
                    </div>
                </div>";
                }?>
    </div>
    <a href="./pokemon_form.php">
        <button id='addPokBtn' class='btn btn-warning btn-outline-dark rounded-circle'>
            <i class="fa-solid fa-plus"></i>
        </button>
    </a>
</body>
</html>