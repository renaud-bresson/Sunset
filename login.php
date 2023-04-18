<?php
require_once("./config/autoload.php");
require_once("./config/prettyDump.php");
$db = require_once("./config/db.php");
$manager = new Manager($db);


$connectionFormText = '';

if (isset($_POST['name'])) {
  // Sanitize and validate the user name
  $name = filter_var($_POST['name']);
  if (!preg_match('/^[a-zA-Z0-9_]+$/', $name)) {
    $connectionFormText = "<p class='erreur text-danger bg-night text-center'>Le pseudo ne doit contenir que des lettres, des chiffres et des tirets bas</p>";
  }

  // If name exist redirection to the last page, else error message
  if ($manager->getUserByName($_POST['name'])) {
    $_SESSION['user'] = $manager->getUserByName($_POST['name']);
    header('Location: ' . $_SESSION['lastPage']);
    exit();
  } else {
    $connectionFormText = "<p class='erreur text-danger bg-night text-center'>Utilisateur inconnu<br>Enregistrez-vous!</p>";
  }
}


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
  <!-- CUSTOM LOGIN CSS -->
  <link rel="stylesheet" href="./css/bootstrap.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />




  <title>Log In|ComparOperator</title>

</head>

<body>

  <?php require_once("./partials/navbar.php"); ?>
  <div class="p-5"></div>

  <div class="container overflow-hidden">
    <div class="screen">
      <div class="screen__content">
        <div class="text-center">
          <h2 class="fancy pt-4">Log In</h2>
        </div>
        <form class="login" method="post" action="./login.php">
          <div class="login__field">
            <i class="login__icon fas fa-user"></i>
            <input type="text" class="login__input text-sandyellow" name="name" placeholder="User name / Email">
          </div>

          <?= $connectionFormText ?>

          <button class="button login__submit">
            <span class="button__text">Log in</span>
            <i class="button__icon fas fa-chevron-right"></i>
          </button>
        </form>

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js" integrity="sha512-rpLlll167T5LJHwp0waJCh3ZRf7pO6IT1+LZOhAyP6phAirwchClbTZV3iqL3BMrVxIYRbzGTpli4rfxsCK6Vw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script src="./js/login.js"></script>

</html>