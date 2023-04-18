<?php
require_once("./config/autoload.php");
require_once("./config/prettyDump.php");
$db = require_once("./config/db.php");
$manager = new Manager($db);




//redirection de /admin vers ./admin.php
if (strpos($_SERVER['REQUEST_URI'], '/admin') !== false) {
    header('Location: ./admin.php');
    exit();
}

$allLocations = $manager->getAllLocations();


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.css">
    <title>Sunset</title>
</head>

<body>

    <?php require_once('./partials/navbar.php') ?>

    <?php require_once('./partials/carousel.php') ?>
    
    <div class="p-5"></div>

    <div class="container overflow-hidden">
        <div class="screen">
            <div class="screen__content">
                <div class="text-center">
                    <h2 class="pt-4">Welcome on <span class="fancy mb-4">Sunset</span></h2>
                </div>

                <div class="destination mt-5 mb-5 d-flex flex-column">
                    <?php require_once("./partials/locationsForm.php"); ?>
                </div>


            </div>
            <div class="screen__background">
                <span class="screen__background__shape screen__background__shape4"></span>
                <span class="screen__background__shape screen__background__shape3"></span>
                <span class="screen__background__shape screen__background__shape2"></span>
                <span class="screen__background__shape screen__background__shape1"></span>
            </div>
        </div>
    </div>
    <div class="p-5"></div>

    <?php require_once("./partials/footer.php")  ?>

</body>

<script src="./js/indexButton.js"></script>
<script src="./js/delayFunction.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</html>