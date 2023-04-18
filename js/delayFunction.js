

// Récupération du formulaire
let formButton = document.getElementById('submitbtn');

// Ajout d'un événement "submit" au formulaire
formButton.addEventListener('click', function (event) {
    // Empêcher la soumission immédiate du formulaire
    console.log(event);
    event.preventDefault();

    // Attente de 2,5 secondes avant de soumettre le formulaire
    setTimeout(function () {
        // Soumission du formulaire

        // window.location.href = 'DisplayDestination.php';
        console.log(document.locationForm);
        document.locationForm.submit();
    }, 2500); // 2,5 secondes de délai
});



