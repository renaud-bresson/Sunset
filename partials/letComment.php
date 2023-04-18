<?php

if (isset($_SESSION['user'])) {
  if ($manager->getUserReviewForOperator($_SESSION['user']->getId(), $tour_operator_id)) {
    echo "<p class='text-danger bg-night text-center'>Vous avez déjà laissé un commentaire pour cette compagnie</p>";
  } else {
    echo "
      <form class='bg-twilightorange' action='./DisplayDestination.php?location={$_GET['location']}' method='post'>
      <input type='hidden' name='author_id' value='{$_SESSION['user']->getId()}'>
      <input type='hidden' name='tour_operator_id' value='{$tour_operator_id}'>
      <input type='text' class='bg-sandyellow text-night mt-2' name='message' placeholder='Votre commentaire ici' required>
      <br>
      <label for='value'>Saisissez une note</label>
      <input type='number' class='bg-sandyellow text-night' id='value' name='value'min='0' max='5' step='0.1'>
      <br>
      <button type='submit' class='btn bg-sandyellow text-night mb-2'>Valider</button>
      </form>
    ";
  }
} else {
  echo "<p class='text-danger bg-night text-center'><a href='./login.php'>Connectez-vous</a> pour laisser un commentaire</p>";
}
