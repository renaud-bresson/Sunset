<?php
class Certificate{

  private DateTime $expiresAt;
  private string $signatory;
  
  

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

  public function getExpiresAt(){
    return $this->expiresAt;
  }

  public function setExpiresAt($expiresAt){
    $this->expiresAt = $expiresAt;

    return $this;
  }

  public function getSignatory(){
    return $this->signatory;
  }

  public function setSignatory($signatory){
    $this->signatory = $signatory;

    return $this;
  }
}
?>