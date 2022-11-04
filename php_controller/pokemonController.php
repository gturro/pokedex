<?php
session_start();

include '/pokedex/php_librarys/pokedex_array.php';

if (!isset($_SESSION["pokedex"])){
    $_SESSION["pokedex"] = array();
}


// ADD POKEMON
    if ( isset($_POST['createPokemon']) ) {

        $number = $_POST['pokNum'];
        $name = $_POST['pokName'];
        $region = $_POST['pokRegion']; 
        $type = $_POST['types[]'];
        $height = $_POST['pokHeight'];
        $weight = $_POST['pokWeight'];
        $evo = $_POST['pokEevo'];
        
        if(!getimagesize($_FILES['pokImg']['tmp_name'])) {
            echo "Please select an image.";
        } else {
            $uploadDir = "/Applications/MAMP/htdocs/pokedex/media/pokemons/";
            $uploadFile = $uploadDir . basename($_FILES["pokImg"]["name"]);
            $uploadImgState = "";
        
            if ( move_uploaded_file($_FILES["pokImg"]["tmp_name"], $uploadFile) ){
                $uploadImgState = "Image is valid, and was successfully uplaoded.";
            } else {
                $uploadImgState = "Upload cancelled. Error verifying file.";
            }
            echo "<script>alert('$uploadImgState')</script>";
        }

        
        addPok(createPok($number, $name, $region, $type, $height, $weight, $evo, $img));
    }
    


?>