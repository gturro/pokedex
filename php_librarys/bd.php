<?php
/*  
    TYPES: 
        (1, 'Planta');
        (2, 'Veneno');
        (3, 'Fuego');
        (4, 'Volador');
        (5, 'Agua');
        (6, 'Eléctrico');
        (7, 'Hada');
        (8, 'Bicho');
        (9, 'Lucha');
        (10, 'Psíquico'); 
*/

function openDB() {
    $servername = "localhost";
    $username = "root";
    $password = "root";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=pokedex", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->exec("set names utf8");
        return $conn;
    } catch(PDOException $e) {
        $_SESSION["error"] = errorMssg($e);
        header("Location: ". $_SERVER['HTTP_REFERER']);
    }
} 

function closeDB() {
    return null;
}


function  selectAllPokemons() {
    try {
        $conn = openDB();

        $sql = "SELECT * FROM pokemons";
    
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //add types to each pokemon
        foreach ($result as &$pokemon) {
            $pokemon["tipos"] = selectPokemonTypes($pokemon["id"]);
        }

        $conn = closeDB();
    
        return $result;
    } catch (PDOException $e) {
        $_SESSION["error"] = errorMssg($e);
    }

}

function  selectTypes() {
    try {
        $conn = openDB();

        $sql = "SELECT * FROM tipos";
    
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $conn = closeDB();

        return $result;
    } catch (PDOException $e) {
        $_SESSION["error"] = errorMssg($e);
    }

}

function  selectRegions() {
    try {
        $conn = openDB();

        $sql = "SELECT * FROM regiones";
    
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $conn = closeDB();
    
        return $result;
    } catch (PDOException $e) {
        $_SESSION["error"] = errorMssg($e);
    }

}

function selectPokemon($id) {
    try {
        $conn = openDB();

        $sql = "SELECT * FROM pokemons WHERE id=:id";
    
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $result[0]["tipos"] = selectPokemonTypes($result[0]["id"]);
    
        $conn = closeDB();
    
        return $result[0];
    } catch (PDOException $e) {
        $_SESSION["error"] = errorMssg($e);
    }
}

function selectID($number) {
    try {
        $conn = openDB();

        $sql = "SELECT id FROM pokemons WHERE numero=:number";
    
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":number", $number);
        $stmt->execute();
    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        $conn = closeDB();
        if (!$result) {
            $_SESSION["error"] = "No match for pokemon number <$number>";
        }
        return $result["id"];
    } catch (PDOException $e) {
        $_SESSION["error"] = errorMssg($e);
    }
}

function selectPokemonTypes($id) {
    try {
        $conn = openDB();

        $sql = "SELECT tipos_has_pokemons.tipos_id as typeID, tipos.nombre as typeName FROM tipos_has_pokemons INNER JOIN tipos ON tipos.id = tipos_has_pokemons.tipos_id WHERE tipos_has_pokemons.pokemons_id = :id;";
    
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $conn = closeDB();
    
        return $result;
    } catch (PDOException $e) {
        $_SESSION["error"] = errorMssg($e);
    }
}

function insertPokemon($number, $name, $height, $weight, $evo, $region, $types, $imgPath) {
    $added = false;
    try {
        $conn = openDB();
        $conn->beginTransaction();
    
        $sql = "INSERT INTO pokedex.pokemons (id, numero, nombre, altura, peso, evolucion, imagen, regiones_id) VALUES (DEFAULT, :number, :name, :height, :weight, :evo, :imgPath, :region);";
    
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":number", $number);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":height", $height);
        $stmt->bindParam(":weight", $weight);
        $stmt->bindParam(":evo", $evo);
        $stmt->bindParam(":imgPath", $imgPath);
        $stmt->bindParam(":region", $region);
        $stmt->execute();
    
        $id = $conn->lastInsertId();

        if ($types != null) {
            foreach ($types as $type) {
                $sql = "INSERT INTO tipos_has_pokemons (tipos_id, pokemons_id) SELECT tipos.id, :id FROM tipos WHERE tipos.nombre=:type";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(":id", $id);
                $stmt->bindParam(":type", $type["typeName"]);
                $stmt->execute();
            }
        }
        
        $conn->commit();
        $conn = closeDB();

        $added = true;
    } catch (PDOException $e) {
        $_SESSION["error"] = errorMssg($e, $number, $name);
        $added = false;
    }
    return $added;
}

function deletePok($id) {
    $deleted = false;
    try {
        $conn = openDB();

        $sql = "DELETE FROM pokemons where id = :id";
    
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0){
            $deleted = true;
        }
        $conn = closeDB();
    } catch (PDOException $e) {
        $_SESSION["error"] = errorMssg($e);
    }
    return $deleted;
}

/**
 * Modifies pokemon variables from mysql DB
 * Drops all types associated with this pokemon
 * Insert all new types given by @param array $types
 *
 * @param int $id
 * @param string $number
 * @param string $name
 * @param int $height
 * @param double $weight
 * @param string $evo
 * @param string $imgPath
 * @param int $region
 * @param array $types
 * @return void
 */
function updatePokemon($id, $number, $name, $height, $weight, $evo, $region, $types, $imgPath) {
    $updated = false;
    try {
        $conn = openDB();
        $conn->beginTransaction();
    
        if ($imgPath == "" || $imgPath == null){
            $sql = "UPDATE pokemons SET numero = :number, nombre=:name, altura = :height, peso = :weight, evolucion = :evo, regiones_id = :region where id = :id";
        } else {
            $sql = "UPDATE pokemons SET numero = :number, nombre=:name, altura = :height, peso = :weight, evolucion = :evo, imagen = :imgPath, regiones_id = :region where id = :id";
        }
    
    
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":number", $number);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":height", $height);
        $stmt->bindParam(":weight", $weight);
        $stmt->bindParam(":evo", $evo);
        if ($imgPath != "" || $imgPath != null){
            $stmt->bindParam(":imgPath", $imgPath);
        }
        $stmt->bindParam(":region", $region);
        $stmt->execute();
    
        //given pokemon id we delete all it's types
        $sql = "DELETE FROM tipos_has_pokemons WHERE pokemons_id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
    
        //insert all new types
        foreach ($types as $type) {
            $sql = "INSERT INTO tipos_has_pokemons SELECT tipos.id, :id FROM tipos WHERE tipos.nombre = :typeName";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":typeName", $type["typeName"]); //WATCH TYPENAME
            $stmt->execute();
        }
    
        $conn->commit();
        $conn = closeDB();

        $updated = true;
    } catch (PDOException $e) {
        $_SESSION["error"] = errorMssg($e, $number, $name);
        $updated = false;
    }
    return $updated;
}

function errorMssg($e, $number = null, $name = null) {
    if (!empty($e->errorInfo[1])){
        switch ($e->errorInfo[1]) {
            case 1072:
                    $mssg = "Key column  doesn't exists";
                break;
            case 1393:
                    $mssg = "Can not modify more than one base table through a join view";
                break;
            case 1062:
                    $mssg = "This pokemon ".$number." - ".$name." already exists";
                break;
            case 2002:
                    $mssg = "Conection to database refused";
                break;
            case 1045:
                    $mssg = "Acces to database denied";
                break;
            case 1049:
                    $mssg = $e->errorInfo[2];
                break;
            case 1264:
                    $mssg = "Some value exceds it's max - ". $e->errorInfo[2];
                break;
            case 1366:
                    $mssg = $e->errorInfo[2];
                break;
            default:
                    $mssg = $e->errorInfo[1] . " - " . $e->errorInfo[2]; 
                break;
        }
    } else {
        switch ($e->getCode()){
            case 1044:
                    $mssg = "Incorrect user or password";
                break;
            case 1049:
                $mssg = "Databse unknown";
                break;
            case 2002:
                $mssg = "Server not found";
                break;
            default:
            $mssg = $e->getCode() ." - ". $e->getMessage();
            break;
        }
    }
    return $mssg;
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