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
    <title>My pokedex</title>
</head>
<body>
    <!-- nav -->
    <?php include './php_partials/menu.php';?>
</body>
</html>