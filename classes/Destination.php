<?php
class Destination{

  private int $id;
  private string $location;
  private int $price;
  private int $tour_operator_id;
    

  public function __construct(array $data){
    $this->hydrate($data);
}


  private function hydrate(array $data){
      // On fait une boucle avec le tableau de données
      foreach ($data as $key => $value) {
          // On récupère le nom des setters correspondants
          // si la clef est id le setter est setId
          // il suffit de mettre la 1ere lettre de key en Maj et de le préfixer par set
          $method = 'set'.ucfirst($key);
          // On vérifie que le setter correspondant existe
          if (method_exists($this, $method)) {
              // S'il existe, on l'appelle
              $this->$method($value);
          }

      }
  }



  // SETTERS & GETTERS

  public function getId(){
    return $this->id;
  }

  public function setId($id){
    $this->id = $id;

    return $this;
  }

  public function getLocation(){
    return $this->location;
  }

  public function setLocation($location){
    $this->location = $location;

    return $this;
  }

  public function getPrice(){
    return $this->price;
  }

  public function setPrice($price){
    $this->price = $price;

    return $this;
  }

  public function getTour_operator_id(){
    return $this->tour_operator_id;
  }

  public function setTour_operator_id($tour_operator_id){
    $this->tour_operator_id = $tour_operator_id;

    return $this;
  }
}
?>