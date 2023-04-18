<?php
class TourOperator{

  private int $id;
  private string $name;
  private string $link;
  private int $certificate;
  private array $destinations;
  private array $reviews;
  private float $scores;
  private int $premium_status;


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

  public function getName(){
    return $this->name;
  }

  public function setName($name){
    $this->name = $name;

    return $this;
  }

  public function getLink(){
    return $this->link;
  }

  public function setLink($link){
    $this->link = $link;

    return $this;
  }

  public function getCertificate(){
    return $this->certificate;
  }

  public function setCertificate($certificate){
    $this->certificate = $certificate;

    return $this;
  }

  public function getDestinations(){
    return $this->destinations;
  }

  public function setDestinations($destinations){
    $this->destinations = $destinations;

    return $this;
  }

  public function getReviews(){
    return $this->reviews;
  }

  public function setReviews($reviews){
    $this->reviews = $reviews;

    return $this;
  }

  public function getScores(){
    return $this->scores;
  }

  public function setScores($scores){
    $this->scores = $scores;

    return $this;
  }

  public function getPremium_status(){
    return $this->premium_status;
  }
 
  public function setPremium_status($premium_status){
    $this->premium_status = $premium_status;

    return $this;
  }
}

?>