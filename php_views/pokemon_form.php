<?php
session_start();
if (isset($_SESSION["pokemon"])){
    $setForm = true;
} else{
    $setForm = false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/Pokedex/style/style.css">
    <script src="https://kit.fontawesome.com/45d5fbd6ce.js" crossorigin="anonymous"></script>
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <?php include '../php_librarys/pokedex_array.php'; ?>
    <title>Pokemon Form</title>
</head>

<body>
    <?php include '../php_partials/menu.php'; ?>

    <div class="container-fluid mt-2">
    <?php require_once "../php_partials/errors_check.php" ?>
        <div class="card-wrapper">
            <div class="card rounded border border-2 border-dark" id="formCard">
                <div class="d-flex align-items-center justify-content-center card-title text-white bg-secondary mb-0">
                    <img src="../media/pokeball.png" width="50px" height="50px" alt="">
                    <?php
                    if(isset($_SESSION['editPokemon'])){
                        echo "Edit ";
                    } else {
                        echo "Create ";
                    }
                    ?> pokemon
                </div>
                <div class="card-body">
                    <form id="pokForm" action="/pokedex/php_controller/pokemonController.php" method="post" enctype="multipart/form-data">
                        <!--Pokemon number-->
                        <div class="row mb-3">
                            <label for="numero" class="col-sm-2 form-label">Number</label>
                            <div class="col-10">
                                <input type="text" name="numero" class='form-control rounded' id="numero" maxlength="3" placeholder="Pokemon number" 
                                <?php 
                                if(isset($_SESSION['editPokemon'])){
                                    echo "readonly ";
                                } else {
                                    echo "autofocus required ";
                                }
                                if ($setForm){
                                    echo "value='".$_SESSION['pokemon']['numero']."'";
                                }
                                ?>
                                >
                            </div>
                        </div>

                        <!--Pokemon Name-->
                        <div class="row mb-3">
                            <label for="nombre" class="col-sm-2 form-label">Name</label>
                            <div class="col-10">
                                <input type="text" name="nombre" class="form-control rounded" id="nombre" placeholder="Pokemon name" required
                                <?php 
                                if($setForm){
                                    echo "value='".$_SESSION['pokemon']['nombre']."'";
                                }
                                ?>
                                >
                            </div>
                        </div>

                        <!--Pokemon Region-->
                        <div class="row mb-3">
                            <label for="regiones_id" class="col-sm-2 form-label">Region</label>
                            <div class="col-10">
                                <select name="regiones_id" class="form-select" id="regiones_id" required>
                                    <option value="1" 
                                    <?php
                                    if($setForm){
                                        if($_SESSION['pokemon']['regiones_id'] == 1){ //Kanto
                                            echo"selected";
                                        }
                                    }
                                    ?>
                                    >Kanto</option>
                                    <option value="2"
                                    <?php
                                    if($setForm){
                                        if($_SESSION['pokemon']['regiones_id'] === 2){ //Jotho
                                            echo"selected";
                                        }
                                    }
                                    ?>
                                    >Jotho</option>
                                    <option value="3"
                                    <?php
                                    if($setForm){
                                        if($_SESSION['pokemon']['regiones_id'] === 3){ //Hoenn
                                            echo"selected";
                                        }
                                    }
                                    ?>
                                    >Hoenn</option>
                                    <option value="4"
                                    <?php
                                    if($setForm){
                                        if($_SESSION['pokemon']['regiones_id'] === 4){ //Sinnoh
                                            echo"selected";
                                        }
                                    }
                                    ?>
                                    >Sinnoh</option>
                                    <option value="5"
                                    <?php
                                    if($setForm){
                                        if($_SESSION['pokemon']['regiones_id'] === 5){ //Teselia
                                            echo"selected";
                                        }
                                    }
                                    ?>
                                    >Teselia</option>
                                </select>
                            </div>
                        </div>
                
                        <!-- Pokemon types  -->
                        <div class="row mb-3">
                            <label class="col-sm-2 form-check-label">Type</label>
                            <div class="col-10">
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" class="form-check-input" name="tipos[][typeName]" id="grassType" value="Grass"
                                    <?php
                                    if($setForm){
                                        if ($_SESSION['pokemon']['tipos'] != null) {
                                            foreach($_SESSION['pokemon']['tipos'] as $type){
                                                if($type["typeName"] === "Grass"){
                                                    echo "checked";
                                                    break;
                                                }
                                            }
                                        }
                                        
                                    }
                                    ?>
                                    >
                                    <label for="grassType" class="form-check-label">Grass</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" class="form-check-input" name="tipos[][typeName]" id="posionType" value="Poison"
                                    <?php
                                    if($setForm){
                                        if ($_SESSION['pokemon']['tipos'] != null) {
                                            foreach($_SESSION['pokemon']['tipos'] as $type){
                                                if($type["typeName"] === "Poison"){
                                                    echo "checked";
                                                    break;
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                    >
                                    <label for="posionType" class="form-check-label">Poison</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" class="form-check-input" name="tipos[][typeName]" id="fireType" value="Fire"
                                    <?php
                                    if($setForm){
                                        if ($_SESSION['pokemon']['tipos'] != null) {
                                            foreach($_SESSION['pokemon']['tipos'] as $type){
                                                if($type["typeName"] === "Fire"){
                                                    echo "checked";
                                                    break;
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                    >
                                    <label for="fireType" class="form-check-label">Fire</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" class="form-check-input" name="tipos[][typeName]" id="flyingType" value="Flying"
                                    <?php
                                    if($setForm){
                                        if ($_SESSION['pokemon']['tipos'] != null) {
                                            foreach($_SESSION['pokemon']['tipos'] as $type){
                                                if($type["typeName"] === "Flying"){
                                                    echo "checked";
                                                    break;
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                    >
                                    <label for="flyingType" class="form-check-label">Flying</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" class="form-check-input" name="tipos[][typeName]" id="waterType" value="Water"
                                    <?php
                                    if($setForm){
                                        if ($_SESSION['pokemon']['tipos'] != null) {
                                            foreach($_SESSION['pokemon']['tipos'] as $type){
                                                if($type["typeName"] === "Water"){
                                                    echo "checked";
                                                    break;
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                    >
                                    <label for="waterType" class="form-check-label">Water</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" class="form-check-input" name="tipos[][typeName]" id="electricType" value="Electric"
                                    <?php
                                    if($setForm){
                                        if ($_SESSION['pokemon']['tipos'] != null) {
                                            foreach($_SESSION['pokemon']['tipos'] as $type){
                                                if($type["typeName"] === "Electric"){
                                                    echo "checked";
                                                    break;
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                    >
                                    <label for="electricType" class="form-check-label">Electric</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" class="form-check-input" name="tipos[][typeName]" id="fairyType" value="Fairy"
                                    <?php
                                    if($setForm){
                                        if ($_SESSION['pokemon']['tipos'] != null) {
                                            foreach($_SESSION['pokemon']['tipos'] as $type){
                                                if($type["typeName"] === "Fairy"){
                                                    echo "checked";
                                                    break;
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                    >
                                    <label for="fairyType" class="form-check-label">Fairy</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" class="form-check-input" name="tipos[][typeName]" id="bugType" value="Bug"
                                    <?php
                                    if($setForm){
                                        if ($_SESSION['pokemon']['tipos'] != null) {
                                            foreach($_SESSION['pokemon']['tipos'] as $type){
                                                if($type["typeName"] === "Bug"){
                                                    echo "checked";
                                                    break;
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                    >
                                    <label for="bugType" class="form-check-label">Bug</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" class="form-check-input" name="tipos[][typeName]" id="fightingType" value="Fighting"
                                    <?php
                                    if($setForm){
                                        if ($_SESSION['pokemon']['tipos'] != null) {
                                            foreach($_SESSION['pokemon']['tipos'] as $type){
                                                if($type["typeName"] === "Fighting"){
                                                    echo "checked";
                                                    break;
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                    >
                                    <label for="fightingType" class="form-check-label">Fighting</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" class="form-check-input" name="tipos[][typeName]" id="psychicType" value="Psychic"
                                    <?php
                                    if($setForm){
                                        if ($_SESSION['pokemon']['tipos'] != null) {
                                            foreach($_SESSION['pokemon']['tipos'] as $type){
                                                if($type["typeName"] === "Psychic"){
                                                    echo "checked";
                                                    break;
                                                }
                                            }
                                        }     
                                    }
                                    ?>
                                    >
                                    <label for="psychicType" class="form-check-label">Psychic</label>
                                </div>
                            </div>
                        </div>

                        <!--Pokemon height-->
                        <div class="row mb-3">
                            <label for="altura" class="col-sm-2 form-label">Height</label>
                            <div class="col-10">
                                <div class="input-group">
                                    <input type="number" class="form-control rounded rounded" name="altura" id="altura" min="1"
                                    <?php 
                                    if($setForm){
                                        echo "value='".$_SESSION['pokemon']['altura']."'";
                                    }
                                    ?>
                                    >
                                    <span class="input-group-text">cm</span>
                                </div>
                            </div>
                        </div>
                        
                        <!--pokemon weight-->
                        <div class="row mb-3">
                            <label for="peso" class="col-sm-2 form-label">Weight</label>
                            <div class="col-10">
                                <div class="input-group">
                                    <input type="number" class="form-control rounded rounded" name="peso" id="peso" min="0" max="999"step=".01" 
                                    <?php 
                                    if($setForm){
                                        echo "value='".$_SESSION['pokemon']['peso']."'";
                                    }
                                    ?>
                                    >  
                                    <span class="input-group-text">kg</span>
                                </div>
                            </div>
                        </div>
                        
                        <!--Pokemon evolution-->
                        <div class="row mb-3">
                            <label for="evolucion" class="col-sm-2 form-check-label">Evolutions</label>
                            <div class="col-10">
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" id="noEvo" name="evolucion" value="Not evolved"
                                    <?php
                                    if($setForm){
                                        if($_SESSION['pokemon']['evolucion'] == "Not evolved"){
                                            echo "checked";
                                        }
                                    }
                                    ?>
                                    >
                                    <label for="noEvo" class="form-check-label">Not evolved</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" id="firstEvo" name="evolucion" value="First evolution"
                                    <?php
                                    if($setForm){
                                        if($_SESSION['pokemon']['evolucion'] === "First evolution"){
                                            echo "checked";
                                        }
                                    }
                                    ?>
                                    >
                                    <label for="firstEvo" class="form-check-label">First evolution</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" id="otherEvo" name="evolucion" value="Second evolution"
                                    <?php
                                    if($setForm){
                                        if($_SESSION['pokemon']['evolucion'] === "Second evolution"){
                                            echo "checked";
                                        }
                                    }
                                    ?>
                                    >
                                    <label for="otherEvo" class="form-check-label">Second evolution</label>
                                </div>
                            </div>
                        </div>

                        <!--Pokemon image-->
                        <div class="row mb-3">
                            <label for="pokImg" class="col-sm-2 form-label">Image</label>
                            <div class="col-10">
                                <input type="file" class="rounded rounded" name="pokImg" id="pokImg" accept="image/png, image/jpeg" style="padding-top:10px;">
                            </div>
                        </div>
                        <!--Submit bttn-->
                        <div id="formSubmit" class="input-group float-end mb-3">
                            <a href="/Pokedex/php_views/pokemon_list.php" class="btn rounded btn-secondary ms-2 me-2">Cancel</a>
                            <input type="submit" name="addPokemon" class="btn rounded btn-primary ms-2 me-2" value="Accept">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>