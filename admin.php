<?php
require_once("./config/autoload.php");
require_once("./config/prettyDump.php");
require_once("./partials/functions.php");
$db = require_once("./config/db.php");
$manager = new Manager($db);

$allOperators = $manager->getAllOperator();
$allLocations = $manager->getAllLocations();

// Vérification si admin, sinon redirection vers l'index
if (!isset($_SESSION['user']) || $_SESSION['user']->getIs_admin() != 1) {
  echo "<link rel='stylesheet' href='./css/bootstrap.css'>
  <html>
  <body>
     <div class='text-center pt-5'>
      <h1 class='text-center text-sandyellow m-5'>Vous n'êtes pas logué en tant qu'Admin</h1>
      <br>
      <h2 class='text-center text-sandyellow'>Vous allez être redirigé dans <span id='notAdmin'>4</span></h2>
     </div>
  </body>
  <script src='./js/isAdmin.js'></script>
</html>";
  die;
}


// Gestion des formulaires d'édition/suppresssion
if (isset($_GET)) {
  if (isset($_GET['delete_operator_id'])) {
    $manager->deleteTourOperator($_GET['delete_operator_id']);
    header('Location: ./admin.php');
    exit;
  }

  if (isset($_GET['update_operator_id'])) {
    $manager->updateOperatorDatas($_GET);
    header('Location: ./admin.php');
    exit;
  }

  if (isset($_GET['createTourOperator'])) {
    $manager->createTourOperator($_GET);
    header('Location: ./admin.php');
    exit;
  }

  if (isset($_GET['createDestination'])) {
    isset ($_GET['otherLocation'])? $_GET['location'] = $_GET['otherLocation'] : '';
    $manager->createDestination($_GET);
    header('Location: ./admin.php?createDestinationSuccess=true');
    exit;
  }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Page</title>
  <link rel="stylesheet" href="./css/bootstrap.css">
  <link rel="stylesheet" href="./css/admin.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

  <?php require_once("./partials/navbar.php")  ?>

  <h1 class="text-center text-twilightorange m-5">Admin Page</h1>

  <section id="listsContainer" class="container row  col-sm-12 align-items-center">

    <section id="operatorSection" class="col-sm-12 text-center text-twilightorange align-items-center">
      <h2>Tour Operators</h2>

      <div id="chooseActionDiv" class="row d-flex justify-content-center-center mt-5 mb-3">
        <button class="w-50 mx-auto btn text-sandyellow bg-seablue" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Operator</button>

        <!-- Modal -->
        <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content bg-night">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter un Tour Operator</h1>
                <button type="button" class="btn-close btn-danger" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="./admin.php" method="get">

                  <input type="hidden" name="createTourOperator" value="true">

                  <label for="name">Nom :</label>
                  <input type="text" class="bg-sandyellow text-night" id="name" name="name" placeholder="nom" required>
                  <br>
                  <label for="link">Lien :</label>
                  <input type="text" class="bg-sandyellow text-night" id="link" name="link" placeholder="www.lien.com" required>
                  <br>
                  <label>Premium ?</label>
                  <input type="radio" name="premium_status" value="1" id="oui" required>
                  <label for="oui">Oui</label>
                  <input type="radio" name="premium_status" value="0" id="non" required>
                  <label for="non">Non</label>
                  <br>
                  <button type="submit" class="btn text-night bg-twilightorange">Ajouter</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <p class="mt-3 mb-0">OU</p>
        <p class="mt-3 mb-0">Consulter/Modifier les Tour Operators dans la liste ci-dessous :</p>
      </div>


      <div id="operatorsList" class="align-items-center text-align-center justify-content-center">

        <ul class="list-unstyled">
          <?php foreach ($allOperators as $operator) : ?>

            <li class="border border-sandyellow bg-black text-twilightorange m-1">

              <form id="updateOperatorForm<?= $operator->getId() ?>" action="./admin.php" method="get" style="display:none">
                <input type="hidden" name="update_operator_id" value="<?= intval($operator->getId()) ?>">

                <label for="name">Nom :</label>
                <input type="text" id="name" class="bg-night text-sandyellow" name="name" placeholder="<?= $operator->getName() ?>" value="<?= $operator->getName() ?>">
                <br>
                <label for="link">Lien :</label>
                <input type="text" class="bg-night text-sandyellow" id="link" name="link" placeholder="<?= $operator->getLink() ?>" value="<?= $operator->getLink() ?>">
                <br>
                <label>Premium ?</label>
                <input type="radio" class="bg-night text-sandyellow" name="premium_status" value="1" <?= $operator->getPremium_status() == 1 ? 'checked' : '' ?> id="oui">
                <label for="oui">Oui</label>
                <input type="radio" class="bg-night text-sandyellow" name="premium_status" value="0" <?= $operator->getPremium_status() == 1 ? '' : 'checked' ?> id="non">
                <label for="non">Non</label>
                <br>
                <button type="submit" class="btn bg-night text-sandyellow">Modifier</button>
                <button class="btn bg-night text-sandyellow" id="updateOperatorFormCancelButton<?= $operator->getId() ?>" type="">Annuler</button>
              </form>

              <div id="operatorDiv<?= $operator->getId() ?>" style="display:block">
                <h4 class="">
                  <?= $operator->getName() ?>
                  <?= $operator->getPremium_status() == 1 ? "<i class='fa-solid fa-star' style='color: #d6a800;' title='Premium'></i>" : "" ?>
                </h4>

                <p>
                  <a href="<?= $operator->getLink() ?>"><?= $operator->getLink() ?></a>
                </p>

                <p>
                  <?php if ($manager->getTourOperatorScore($operator->getId()) != 'aucune evaluation') : ?>
                    Note : <?= ranking($manager->getTourOperatorScore($operator->getId())) ?>
                  <?php else : ?>
                    <?= $manager->getTourOperatorScore($operator->getId()) ?>
                  <?php endif ?>
                </p>


                <p class="text-end">
                  <span><i class="fa-solid fa-trash btn cursor-pointer" style="color: #ff4000;" title="Supprimer" data-bs-toggle="modal" data-bs-target="#deleteModal<?= $operator->getId() ?>"></i></span>

                  <span id="updateIcon<?= $operator->getId() ?>"><i class="fa-solid fa-pencil btn cursor-pointer" style="color: #39f346;" title="Editer"></i></span>
                </p>
              </div>



              <div class="modal fade" id="deleteModal<?= $operator->getId() ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Supprimer <?= $operator->getName() ?> ?</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="./admin.php" method="get">
                        <input type="hidden" name="delete_operator_id" value="<?= intval($operator->getId()) ?>">
                        <br>
                        <button type="submit">Valider</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

            </li>

          <?php endforeach ?>
        </ul>

      </div>

    </section>

    <section id="destinationsSection" class=" text-center">

      <h2 class="text-twilightorange">Voyages</h2>

      <div id="createDestinationSuccess" class="row mt-5 mb-3 text-center text-success text-xl" style="display:<?= isset($_GET['createDestinationSuccess']) ? 'block' : 'none' ?>">
        Voyage créé avec succès
      </div>

      <div id="chooseActionDiv" class="row d-flex justify-content-center mt-5 mb-3">
        <button class="w-50 mx-auto btn text-sandyellow bg-seablue" data-bs-toggle="modal" data-bs-target="#createDestinationModal">Add voyage</button>

        <!-- Modal -->
        <div class="modal fade text-twilightorange" id="createDestinationModal" tabindex="-1" aria-labelledby="createDestinationModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content bg-night">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="createDestinationModalLabel">Ajouter un voyage</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="./admin.php" method="get">

                  <input type="hidden" name="createDestination" value="true">

                  <label for="selectLocation">Choisir une option :</label>

                  <select id="selectLocation" name="location">
                    <?php foreach ($allLocations as $location) : ?>
                      <?= prettyDump($location)?>
                      <option value="<?= $location ?>" required><?= $location ?></option>
                    <?php endforeach; ?>
                    <option value="other">Autre</option>
                  </select>

                  <div id="otherInput" style="display:none;">
                    <label for="otherLocation">Saisir une autre destination :</label>
                    <input type="text" id="otherLocation" name="otherLocation">
                  </div>

                  <script>
                    var selectLocation = document.getElementById("selectLocation");
                    var otherInput = document.getElementById("otherInput");
                    var otherLocation = document.getElementById("otherLocation");

                    selectLocation.addEventListener("change", function() {
                      if (selectLocation.value === "other") {
                        otherInput.style.display = "block";
                      } else {
                        otherInput.style.display = "none";
                        otherLocation.value = selectLocation.value
                      }
                    });
                  </script>

                  <br>
                  <label for="price">Prix :</label>
                  <input type="number" id="price" class="bg-sandyellow text-seablue" name="price" required>
                  <br>

                  <label for="selectOperator">Choisir un Tour Operator :</label>

                  <select id="selectOperator" name="tour_operator_id">
                    <?php foreach ($allOperators as $operator) : ?>
                      <option value="<?= $operator->getId() ?>" required><?= $operator->getName() ?></option>
                    <?php endforeach; ?>
                  </select>
                  <br>
                  <button class="btn text-night bg-twilightorange" type="submit">Créer</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

    </section>

  </section>


</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js" integrity="sha512-rpLlll167T5LJHwp0waJCh3ZRf7pO6IT1+LZOhAyP6phAirwchClbTZV3iqL3BMrVxIYRbzGTpli4rfxsCK6Vw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script src="./js/login.js"></script>
<script src="./js/adminUpdateForm.js"></script>

</html>