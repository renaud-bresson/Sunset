<?php
require_once("./config/autoload.php");
require_once("./config/prettyDump.php");
require_once("./partials/functions.php");
$db = require_once("./config/db.php");
$manager = new Manager($db);

if (parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH) != $_SERVER['REQUEST_URI']) {
  $_SESSION['lastPage'] = $_SERVER['HTTP_REFERER'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/bootstrap.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>JourneyDetail</title>
</head>

<body>

  <?php require_once("./partials/navbar.php") ?>

  <?php
  $tourOperator = $manager->getTour_operator($_GET['tour_operator_id']);
  $destination = $manager->getDestinationForTourOperator($_GET['location'], $_GET['tour_operator_id']);

  ?>

  <div class="containerDestination overflow-hidden">
    <div class="screenDestination2">
      <div class="screenDestination2__content px-5 py-2 mt-3 mb-3 text-sandyellow">
        <h1 class="text-center fw-bold">
          <?= $destination->getLocation() ?>
        </h1>

        <p class="text-center fw-bold">
          Séjour de <?= $test = $randomDuration() ?> jours, <?= $test - 1 ?> nuits
        </p>

        <h4>
          Prix : <?= $destination->getPrice() ?> €
        </h4>

        <h4>
          Tour Opérateur : <?= $tourOperator->getName() ?>
        </h4>

        <p>
          <?php if ($manager->getTourOperatorScore($tourOperator->getId()) != 'aucune evaluation') : ?>
            Evaluation : <?= ranking($manager->getTourOperatorScore($tourOperator->getId())) ?>
          <?php else : ?>
            Evaluation : <?= $manager->getTourOperatorScore($tourOperator->getId()) ?>
          <?php endif ?>
        </p>

        <p>
          Départ de <?= $randomDepartures() ?> le <?= $randomDate() ?>
        </p>

        <div>
          <strong>Les Incontournables</strong> :
          <ul>
            <?php foreach ($randomSites() as $site) : ?>
              <li><?= $site ?></li>
            <?php endforeach ?>
          </ul>
        </div>

        <div class="text-night changeco text-shadow">
          <strong>Extras</strong> :
          <ul>
            <?php foreach ($randomExtras() as $extras) : ?>
              <li><?= $extras ?></li>
            <?php endforeach ?>
          </ul>
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

  <?php require_once("./partials/footer.php")   ?>

</body>

</html>