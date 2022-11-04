<?php
session_start();

if (!isset($_SESSION["pokedex"])){
    $_SESSION["pokedex"] = array();
}

$uploadDir = "/pokedex/media/pokemons/";

$uploadFile = $uploadDir . basename($_FILES["pokImg"]["name"]);

$uploadImgState = "";

if ( move_uploaded_file($_FILES["pokImg"]["tmp_name"], $uploadFile) ){
    $uploadImgState = "Image is valid, and was successfully uplaoded.";
} else {
    $uploadImgState = "Upload cancelled. Error verifying file.";
}


?>