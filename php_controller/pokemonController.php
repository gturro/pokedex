<?php
session_start();
require_once "../php_librarys/bd.php";


// ADD POKEMON
if ( isset($_POST['addPokemon']) ) {    
    if (isset($_SESSION['editPokemon'])) {
        modifyPokemon(); //UPDATE POKEMON
    } else {
        newPokemon(); //CREATE POKEMON
    }
}
//CREATE POKEMON
function newPokemon() {
    if (!isset($_POST['type'])){
        $_POST['type'] = array();
    }
    
    $_SESSION["pokemon"] = array(
        "numero"      => $_POST['numero'],
        "nombre"      => $_POST['nombre'],
        "altura"        => $_POST['altura'],
        "peso"         => $_POST['peso'],
        "evolucion"    => $_POST['evolucion'],
        "regiones_id"  => $_POST['regiones_id'],
        "tipos"         => $_POST['tipos'],
        "imagen"       => "/pokedex/media/pokemons/".$_POST["numero"].".png"
    );

    $pokemon = $_SESSION["pokemon"];

    setEmptyToNull($pokemon);
    
    uploadPokemonImage($pokemon);
    if (insertPokemon($pokemon["numero"], $pokemon["nombre"], $pokemon["altura"], $pokemon["peso"], $pokemon["evolucion"], $pokemon["regiones_id"], $pokemon["tipos"], $pokemon["imagen"])) {
        $_SESSION['success'] = "[".$pokemon["numero"]." - ".$pokemon["nombre"]."] added.";
        goToList();
    }
    
}

//UPDATE POKEMON
function modifyPokemon() {
    $pokemon = $_SESSION["pokemon"];
    

    if(!empty($_FILES['pokImg']['tmp_name'])) {
        if(deletePokemonImage($pokemon)) {
            uploadPokemonImage($pokemon);
        } else if (uploadPokemonImage($pokemon)){
        } else {
            goToForm();
        }
    }

    setEmptyToNull($_POST);
    if (updatePokemon($pokemon["id"], $_POST["numero"], $_POST["nombre"], $_POST["altura"], $_POST["peso"], $_POST["evolucion"], $_POST["regiones_id"],  $_POST["tipos"], $_POST["imagen"])) {
        $_SESSION['success'] = "[". $_POST["numero"] ." - ". $_POST["nombre"]."] updated.";
        goToList();
    } else {
        goToForm();
    }
    
}

// DELETE POKEMON
if (isset($_POST['deletePokemon'])) {
    $pokemon = selectPokemon(selectID($_POST['deletePokemonNum']));
    if (pokemonExists($pokemon)) {
        deletePokemonImage($pokemon);
        if(deletePok($pokemon["id"])){
            $_SESSION['success'] = "[".$pokemon["numero"] . " - ". $pokemon["nombre"] ."] deleted.";
        }
    }
    goToList();
}

/** EDIT POKEMON
 * gets pokemom with ID from SESSION pokedex
 * If pokemon to edit is valid, stores pokemon into SESSION variable ["pokemon"]
 */ 
if (isset($_POST['editPokemon'])){ 
    $pokemon = getPokemonByID($_POST['editPokemonID']);
    if (pokemonExists($pokemon)) {
        $_SESSION["pokemon"] = $pokemon;
        $_SESSION['editPokemon'] = true;
    }
    goToForm();
}


//--- UTILITIES ---
/**Checks if pokemon is a valid var and not null
 * @return can be false if there is an error in the DB SELECT
**/
function pokemonExists($pokemon) {
    $itExists = false;
    if ($pokemon && $pokemon != null) {
        $itExists = true;
    }
    return $itExists;
}

//Deletes pokemon image from local storage
function deletePokemonImage($pokemon) {
    $deleted = false;
    $img_file_path = $_SERVER["DOCUMENT_ROOT"] . $pokemon["imagen"];
    if (file_exists($img_file_path)) {
        if (unlink($img_file_path)) {
            $deleted = true;
        } else {
            $_SESSION['error'] = "Pokemon image couldn't be deleted. There was a problem deleting the image file.";
        }
    }
    return $deleted;
}

function uploadPokemonImage($pokemon) {
    $uploaded = false;
    if(!empty($_FILES['pokImg']['tmp_name'])) {
        $uploadDir = $_SERVER["DOCUMENT_ROOT"] . "/pokedex/media/pokemons/";
        $fileName = $pokemon["numero"].".png";
        $_FILES["pokImg"]["name"] = $fileName;
        $uploadFile = $uploadDir . basename($_FILES["pokImg"]["name"]);

        if (file_exists($uploadFile)){
            $_SESSION['error'] = "Image file ".$fileName." already exists.";
            goToForm();
        } else {
            if ( move_uploaded_file($_FILES["pokImg"]["tmp_name"], $uploadFile) ){
                $uploaded = true;
            } else {
                $_SESSION['error'] = "Upload cancelled. Error verifying file.";
                goToForm();
            }
        }
    } /* else {
        $_SESSION['error'] = "To add a new pokemon you need to upload a image.";
        goToForm();
    } */
    return $uploaded;
}

/**
 * Returns pokemon from SESSION[pokedex] or null if there is no ID match
 * @param int $id
 * @return array||null
 */
function getPokemonByID($id) {
    $result = null;
    foreach($_SESSION["pokedex"] as $pokemon){
        if ($pokemon["id"] == $id) {
            $result = $pokemon;
            break;
        } 
    }
    return $result;
}

/**
 * Sets all empty{""} values to null
 * @param array $pokemon
 */
function setEmptyToNull(&$pokemon) {
    foreach($pokemon as &$atrib) {
        if ($atrib == ""){
            $atrib = null;
        }
    }
}

/**
 * Redirects to form page
 * @return header
 */
function goToForm() {
    return header("Location: /pokedex/php_views/pokemon_form.php");
}

/**
 * Redirects to view list page
 * @return header
 */
function goToList() {
    return header("Location: /pokedex/php_views/pokemon_list.php");
}
?>