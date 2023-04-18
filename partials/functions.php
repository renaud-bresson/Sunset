<?php


//Fonction pour rajouter des étoiles en fonction de la note
function ranking(float $note){
  $fullStar = "<i class='fa-solid fa-star' style='color: #d6a800;'></i>";
  $halfStar = "<i class='fa-regular fa-star-half-stroke' style='color: #d6a800;'></i>";
  $emptyStar = "<i class='fa-regular fa-star' style='color: #d6a800;'></i>";

  $return = '';

  for ($i=1; $i<=5 ; $i++){
    if ($i <= $note){
      $return .= $fullStar;
    } elseif ($i-$note <1){
      $return .= $halfStar;
    } else {
      $return .= $emptyStar;
    }
  }

  return $return;
}

//Fonction pour afficher une date random dans le futur
$randomDate = function () {
  $days = [2, 4, 6, 8, 10, 12, 14, 16, 18, 20, 30, 40, 50];
  $hours = [0, 2, 4, 6, 12, 18];
  return date('d/m/Y à h\hi', time()+((3600*24*$days[array_rand($days)])+(3600*$hours[array_rand($hours)])));
};


// Fonction pour afficher une durée random
$randomDuration = function(){
  $duration = [4, 5, 6, 7, 8, 10];
  return $duration[array_rand($duration)];
};


// Fonction pour afficher des sites incontournables random
$randomSites = function(){
  $sites = [
    "Place de l'Hotel de Ville",
    "Cimetière Anglais",
    "Cimetière des révolutions",
    "Eglise noire",
    "Temple ancien",
    "Verger partagé",
    "Rue de la soif",
    "Place aux trois fontaines",
    "Place aux Herbes",
    "Marché couvert",
    "Marché aux fleurs",
    "Marché du soleil",
    "Grandes Halles",
    "Musée d'Arts Modernes",
    "Musée des Beaux-Arts",
    "Musée de la Cravatte",
    "Musée du Tissage",
    "Cité des Vieux Metiers",
    "Jardin botanique",
    "Zoo des animaux heureux",
    "Aquarium tropical",
    "Rue pavée",
    "Kiosque à musique",
    "Rues piétonnes",
    "Rue des artistes",
    "Vieille porte de ville",
    "Jardin public",
    "Place du vieux village",
    "Ruelles médiévales",
    "Jardin de roses",
    "Petit théâtre de quartier"
  ];
  shuffle($sites);
  return array_slice($sites, 0, 5);
};


//Fonction pour afficher un lieu de départ random
$randomDepartures = function(){
  $cities = [
    "Roanne",
    "Le Coteau",
    "Mably",
    "Feurs",
    "Balbigny",
    "Villerest",
    "Renaison",
    "Riorges",
    "Charlieu",
    "Saint Etienne"
  ];
  return $cities[array_rand($cities)];
};


//Fonction pour afficher des extras random
$randomExtras = function(){
  $extras = [
    "Eau gratuite pendant le séjour",
    "Prêt de pantoufles à l'hotel",
    "Serviettes de bain sèches",
    "Savon à l'odeur supportable",
    "Visites guidées en option",
    "Minibus assez fiable",
    "Service de location de VHS",
    "Brochures touristique sur demande",
    "Boutiques souvenirs",
    "Discussions possibles",
    "Aide aux selfies",
    "Lit à matelas",
    "Autocollant publicitaire offert",
    "Wi-Fi probable",
    "Kebab à proximité",
    "Location de brosses à dents",
    "Bouilloire à disposition",
    "Rappel SMS du départ"
  ];
  shuffle($extras);
  return array_slice($extras, 0, 3);
};





?>