<?php
class Author{

  private int $id;
  private string $name;
  private int $is_admin; 
    

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

  public function getIs_admin(){
    return $this->is_admin;
  }

  public function setIs_admin($is_admin){
    $this->is_admin = $is_admin;

    return $this;
  }
}
?>