<?php
//include '/Applications/MAMP/htdocs/pokedex/php_partials/errors_check.php';

/* if (!isset($_SESSION["pokedex_init"])) {
    $_SESSION["pokedex"] = array();
    initPokedex();
} */
/* $_SESSION["errors"] = array(
    "add" => false,
    "modify" => false,
    "delete" => false
);

$_SESSION["errors_msg"] = array(
    "add" => "",
    "delete" => "",
    "modify" => ""
); */



//----------- EXISTING POKEMONS -----------
function initPokedex(){
    $_SESSION["pokedex_init"] = true;
    addPok(createPok("001", "Bulbasur", "Hoen", ["Grass", "Poison"], 70, 6.9, 0, "001"));
    addPok(createPok("002", "Ivysaur", "Hoen", ["Grass", "Poison"], 100, 13, 1, "002"));
    addPok(createPok("003","Venusaur", "Hoen", ["Grass", "Poison"], 200, 100, 2, "003" ));
    addPok(createPok("004", "Charmander", "Jotho", ["Fire"], 60, 8.5, 0, "004"));
    addPok(createPok("005", "Charmeleon", "Jotho", ["Fire"], 110, 19, 1, "005"));
    addPok(createPok("006", "Charizard", "Jotho", ["Fire", "Flying"], 170, 90.5, 2, "006"));
    addPok(createPok("007", "Squirtle", "Kanto", ["Water"], 50, 9, 0, "007"));
    addPok(createPok("008", "Wartortle", "Kanto", ["Water"], 100, 22.5, 1, "008"));
    addPok(createPok("009", "Blastoise", "Kanto", ["Water"], 160, 85.5, 2, "009"));
    addPok(createPok("010", "Caterpie", "Kanto", ["Bug"], 30, 2.9, 0, "010"));
    unset($_SESSION['errors']['add']);
    unset($_SESSION['errors_msg']['add']);
    
}
   

/**
 * Generates a pokemon array with this values:
 * @param string $number
 * @param string $name
 * @param string $region
 * @param array $type
 * @param int|double $height
 * @param int|double $weight
 * @param int $evo
 * @param string $img (path)
 */
function createPok($number, $name, $region, $type, $height, $weight, $evo){
    $pokemon = array(
        "number"    => $number,
        "name"      => $name,
        "region"    => $region,
        "type"      => $type,
        "height"    => $height,
        "weight"    => $weight,
        "evo"       => $evo,
        "img"       => "/Pokedex/media/pokemons/".$number.".png"
    );
    return $pokemon;
}


/**
 * Logs in a basic html table a pokemon with:
 * @param string $key
 * @param string|int|float|array $val
 */
function printPok($pokemon){
    echo "<div class='pokemonLog'>
            <table id='pokemonTable';>
                <tr>
                <td colspan='2' align='center'><img src=".$pokemon['img']."></img></td>
                </tr>
                <tr>
                <td>number</td>
                <td>" .$pokemon["number"]. "</td>
                </tr>
                <tr>
                <td>Name</td>
                <td>".$pokemon["name"]."</td>
                </tr>
                <tr>
                <td>Region</td>
                <td>".$pokemon["region"]."</td>
                </tr>
                <tr>
                <td>Type</td>
                <td>". printPokemonTypes($pokemon["type"]) ."</td>
                </tr>
                <tr>
                <td>Height</td>
                <td>".$pokemon["height"]."</td>
                </tr>
                <tr>
                <td>Weight</td>
                <td>".$pokemon["weight"]."</td>
                </tr>
                <tr>
                <td>Evolution</td>
                <td>".$pokemon["evo"]."</td>
                </tr>    
            </table>
          </div>";
};


/**
 * Logs all pokemons in $_SESSION["pokedex"] in a basic html table
 */
function printPokedex(){
    echo "<div class='pokedexLog'>";
    foreach($_SESSION["pokedex"] as $pokemon) {
       printPok($pokemon);
    }
    echo "</div>";
};


/**
 * ADD @param array $pokemon to the Pokedex
 * push add state to log events $_SESSION['log']
 */
function addPok($pokemon){
    if (!pokemonExists($pokemon)){
        array_push($_SESSION["pokedex"], $pokemon);
        $_SESSION["errors"]["add"] = false;
        $_SESSION['errors_msg']['add'] = $pokemon['name']." added successfully";
    } else {
        $_SESSION["errors"]["add"] = true;
        $_SESSION['errors_msg']['add'] = "Failed to add " .$pokemon["name"]. " to the pokedex beacause it already exists.";
    }
    //checkStatus();
};

/**
 * DELETE pokemon from the Pokedex with:
 * @param string $key
 * @param string|int|float|array $val
 * push function resolution state to $SESSION['deletePokemonState']
 */
function deletePokemon($key, $val){
    $pokemon = getPokemon($key, $val);
    if (pokemonExistsWith($key, $val)){
        array_splice($_SESSION["pokedex"], pokemonIndex($key, $val), 1);
        $_SESSION["errors"]["delete"] = false;
        $_SESSION['errors_msg']['delete'] = $pokemon['name']." deleted successfully";
    } else {
        $_SESSION["errors"]["delete"] = true;
        $_SESSION['errors_msg']['delete'] = "Failed to delete pokemon with $key = $val beacause it doesnt exists in the pokedex";

    }
    //checkStatus();
};


/**
 * @param [type] $key
 * @param [type] $val
 * @param [type] $newVal
 * @return void
 */
function modifyPokemon($key, $val, $newVal){
    if (pokemonExistsWith($key, $val)) {
        $pokemon = getPokemon($key, $val);
        if ($key == "img"){ //en el caso que sea img hardcode la ruta para no tenerla que introducir entera como parametro.
            $_SESSION["pokedex"][pokemonIndex($key, $val)][$key] = "/Pokedex/media/pokemons/".$newVal.".png";
        }else {
            $_SESSION["pokedex"][pokemonIndex($key, $val)][$key] = $newVal;
        }
        $_SESSION['errors_msg']['modfiy'] = $pokemon['name']." has been modified $key: $val to $newVal";
        $_SESSION["errors"]["modfiy"] = false;
    } else {
        $_SESSION["errors"]["modfiy"] = true;
        $_SESSION['errors_msg']['modify'] = "Couldn't find pokemon with $key: $val";
    }
    //checkStatus();
};

function printLogEntries(){
    echo "<script>";
    
    foreach ($_SESSION['log'] as $entrie => $value ) {
        $i=1;
        echo"console.log('$entrie: ');";
        foreach ( $value as $state){
            echo "console.log('$i: $state');";
            $i++;
        }
        
    }
    echo"</script>";
}


/**
 * Checks if a pokemon with $key = $val it exists in pokedex
 * @param string $key
 * @param string|int|float|array $val
 * @return bool $itExists
 */
function pokemonExistsWith ($key, $val){
    $itExists = false;
    if (array_search($val, array_column($_SESSION['pokedex'], $key))){
        $itExists = true;
    } 
    return $itExists;
};


/**
 * Checks if @param array $pokemon exists in $_SESSION["pokedex"]
 * @return bool $itExists
 */
function pokemonExists($pokemon){
    $itExists = false;
    if (array_search($pokemon, $_SESSION["pokedex"])) {
        $itExists = true;
    }
    return $itExists;
}


/**
 * retuns pokemon with $key $val if exixts  
 * If not throws error and prints it to console.log
 * @param string $key
 * @param string|int|float|array $val
 * @return array $pokemon
 */
function getPokemon($key, $val){ 
    return $_SESSION["pokedex"][pokemonIndex($key, $val)];
};

/**
 * Returns index of pokemon with:
 * @param string $key
 * @param string|int|float|array $val
 * @return int
 */
function pokemonIndex($key, $val){
    return array_search($val, array_column($_SESSION["pokedex"], $key));
}


/**
 * Returns all the pokemon types in a string
 * @param [type] $types
 * @return string $pokTypes
 */
function printPokemonTypes($types){
    $pokTypes = $types[0]." ";
    for ($i = 1; $i <= count($types)-1; $i++){
        $pokTypes .= $types[$i] . " ";
    }
    return $pokTypes;
}

/**
 * Returns html element class given  @param array $types
 * @return string $typeClass
 */
function typeBadgeColor($types){
    $typeClass="";
    switch($types){
        case "Poison":
            $typeClass = "type-poison";
            break;
        case "Grass":
            $typeClass = "type-grass";
            break;
        case "Fire":
            $typeClass = "type-fire";
            break;
        case "Flying":
            $typeClass = "type-flying";
            break;
        case "Water":
            $typeClass = "type-water";
            break;
        case "Electric":
            $typeClass = "type-electric";
            break;
        case "Fairy":
            $typeClass = "type-fairy";
            break;
        case "Bug":
            $typeClass = "type-bug";
            break;
        case "Fighting":
            $typeClass = "type-fighting";
            break;
        case "Psychic":
            $typeClass = "type-psychic";
            break;
        default:
            $typeClass = "";
    }
    return $typeClass;
}
?>