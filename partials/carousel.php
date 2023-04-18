<?php

$threeDestinations = $manager->getThreeRandomDestinations();
// var_dump($threeDestinations);
?>


<div id="carouselExampleDark" class="carousel carousel-dark slide w-50 h-25 mx-auto">
  <div class="carousel-indicators ">
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>

  <div class="carousel-inner">

  <?php foreach ($threeDestinations as $destination): ?>
    <?php $tourOperator = $manager->getTour_operator($destination->getTour_operator_id()) ?>
    <a href="./journeyDetail.php?location=<?=$destination->getLocation()?>&tour_operator_id=<?=$tourOperator->getId()?>">
    <div class="carousel-item <?php require_once("./partials/isActive.php")?>" data-bs-interval="10000">
      <img src="../images/bonPlan.png" class="d-block w-25 " alt="...">
      <div class="carousel-caption d-none d-md-block w-75">
        <h3 class="text-sandyellow fw-bold fs-1"><?=$destination->getLocation()?></h3>
        <p class="text-sandyellow">pour <?=$destination->getPrice ()?>€ avec <?= $tourOperator->getName()?></p>
      </div>
    </div>
    </a>
  <?php endforeach ?>

  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>


