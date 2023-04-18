<?php
class Review{

   private int $id;
   private string $message;
   private string $author;
   private int $author_id;

  public function __construct(array $data){
    $this->hydrate($data);
    isset($data['name'])? $this->setAuthor($data['name']):'';
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

   public function getMessage(){
      return $this->message;
   }

   public function setMessage($message){
      $this->message = $message;

      return $this;
   }

   public function getAuthor(){
      return $this->author;
   }

   public function setAuthor($author){
      $this->author = $author;

      return $this;
   }

   public function getAuthor_id(){
      return $this->author_id;
   }

   public function setAuthor_id($author_id){
      $this->author_id = $author_id;

      return $this;
   }
}
?>