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
    <?php include '../php_partials/menu.php'?>
    <div class="card-wrapper">
        <div class="card rounded border border-2 border-dark" id="formCard">
            <div class="card-title text-white bg-secondary mb-0">
                <img src="../media/pokeball.png" width="50px" height="50px" alt="">
                Pokemon
            </div>
            <div class="card-body">
                <form id="pokForm" action="">
                    <!--Pokemon number-->
                    <div class="input-group mb-3">
                        <label for="pokNum" class="col-2 form-label">Number</label>
                        <input type="text" name="pokemon number" class='form-control rounded' id="pokNum" maxlength="3" placeholder="Pokemon number" autofocus>
                    </div>

                    <!--Pokemon Name-->
                    <div class="input-group  mb-3">
                        <label for="pokName" class="col-2 form-label">Name</label>
                        <input type="text" name="pokName" class="form-control rounded" id="pokName" placeholder="Pokemon name">
                    </div>

                    <!--Pokemon Region-->
                    <div class="input-group mb-3">
                        <label for="pokRegion" class="col-2 form-label">Region</label>
                        <select name="region" name="pokRegion" class="form-select" id="pokRegion">
                            <option value="Kanto">Kanto</option>
                            <option value="Jotho">Jotho</option>
                            <option value="Hoenn">Hoenn</option>
                            <option value="Sinnoh">Sinnoh</option>
                            <option value="Teselia">Teselia</option>
                        </select>
                    </div>
            
                    <!-- Pokemon types  -->
                    <div class="input-group mb-3">
                        <label class="col-2 form-check-label">Type</label>
                        <div class="col-10">
                            <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input" name="types[]" id="grassType" value="Grass">
                                <label for="grassType" class="form-check-label">Grass</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input" name="types[]" id="posionType" value="Poison">
                                <label for="posionType" class="form-check-label">Poison</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input" name="types[]" id="fireType" value="Fire">
                                <label for="fireType" class="form-check-label">Fire</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input" name="types[]" id="flyingType" value="Flying">
                                <label for="flyingType" class="form-check-label">Flying</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input" name="types[]" id="waterType" value="Water">
                                <label for="waterType" class="form-check-label">Water</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input" name="types[]" id="electricType" value="Electric">
                                <label for="electricType" class="form-check-label">Electric</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input" name="types[]" id="fairyType" value="Fairy">
                                <label for="fairyType" class="form-check-label">Fairy</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input" name="types[]" id="bugType" value="Bug">
                                <label for="bugType" class="form-check-label">Bug</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input" name="types[]" id="fightingType" value="Fighting">
                                <label for="fightingType" class="form-check-label">Fighting</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="checkbox" class="form-check-input" name="types[]" id="psychicType" value="Psychic">
                                <label for="psychicType" class="form-check-label">Psychic</label>
                            </div>
                        </div>
                    </div>

                    <!--Pokemon height-->
                    <div class="input-group mb-3">
                            <label for="pokHeight" class="col-2 form-label">Height</label>
                            <input type="number" class="form-control rounded rounded" name="pokemon height" id="pokHeight" min="1">
                            <span class="input-group-text">cm</span>
                    </div>
                    
                    <!--pokemon weight-->
                    <div class="input-group mb-3">
                            <label for="pokWeight" class="col-2 form-label">Weight</label>
                            <input type="number" class="form-control rounded rounded" name="pokemon weight" id="pokWeight" min="0" step=".01">  
                            <span class="input-group-text">kg</span>
                    </div>
                    
                    <!--Pokemon evolution-->
                    <div class="input-group mb-3">
                        <label for="pokEvo" class="col-2 form-check-label">Evolutions</label>
                        <div class="col-10">
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="noEvo" name ="pokemon evo" value="0">
                                <label for="noEvo" class="form-check-label">Not evolved</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="firstEvo" name ="pokemon evo" value="1">
                                <label for="firstEvo" class="form-check-label">First evolution</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="otherEvo" name ="pokemon evo" value="2">
                                <label for="otherEvo" class="form-check-label">Other evolution</label>
                            </div>
                        </div>
                    </div>

                    <!--Pokemon image-->
                    <div class="input-group mb-3">
                        <label for="pokImg" class="col-2 form-label">Image</label>
                        <input type="file" class="rounded rounded" name="pokImg" id="pokImg" accept="image/png, image/jpeg" style="padding-top:10px;">
                    </div>
                    <!--Submit bttn-->
                    <div id="formSubmit" class="input-group float-end mb-3">
                        <a href="/Pokedex/index.php" class="btn rounded btn-secondary ms-2 me-2">Cancel</a>
                        <input type="submit" class="btn rounded btn-primary ms-2 me-2" value="Accept">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>