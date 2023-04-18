<?php

class Manager {
  private $db; 

  public function __construct(PDO $db){
      $this->setDb($db);
  }


  public function createTourOperator(array $tour_operator_data){
    $query = $this->db->prepare(' INSERT INTO tour_operator (name, link, premium_status)
                                  VALUES (:name, :link, :premium_status)');
    $query->execute([ 'name' => $tour_operator_data['name'],
                      'link' => $tour_operator_data['link'],
                      'premium_status' => $tour_operator_data['premium_status']]);
  }

  public function createDestination($destination_datas){
    $query = $this->db->prepare(' INSERT INTO destination (location, price, tour_operator_id)
                                  VALUES (:location, :price, :tour_operator_id)');
    $query->execute([ 'location' => $destination_datas['location'],
                      'price' => $destination_datas['price'],
                      'tour_operator_id' => $destination_datas['tour_operator_id']]);
  }

  public function createUserInDB(string $name){
    $query = $this->db->prepare('   INSERT INTO author (name)
                                    VALUES (:name)');
    $query->execute(['name' => $name]);    
  }

  public function createMessageInDB(array $data){
    $query = $this->db->prepare('   INSERT INTO review (message, tour_operator_id, author_id)
                                    VALUES (:message, :tour_operator_id, :author_id)');
    $query->execute([ 'message' => $data['message'],
                      'tour_operator_id' => $data['tour_operator_id'],
                      'author_id' => $data['author_id']]); 
  }

  public function createValueInDB(array $data){
    $query = $this->db->prepare('   INSERT INTO score (value, tour_operator_id, author_id)
                                    VALUES (:value, :tour_operator_id, :author_id)');
    $query->execute([ 'value' => $data['value'],
                      'tour_operator_id' => $data['tour_operator_id'],
                      'author_id' => $data['author_id']]); 
  }

  public function getTour_operator(int $tour_operator_id){
    $query = $this->db->prepare(' SELECT *
                                  FROM tour_operator
                                  WHERE id = :tour_operator_id');
    $query->execute(['tour_operator_id' => $tour_operator_id,]);

    $tourOperatorData = $query->fetch(PDO::FETCH_ASSOC);

    return new TourOperator($tourOperatorData);
  }

  public function getAllOperator(){
    $query = $this->db->query(' SELECT * FROM tour_operator
                                ORDER BY name');

    $allOperatorsData = $query->fetchAll(PDO::FETCH_ASSOC); 

    $allOperatorsAsObjects = [];        
    
    foreach ($allOperatorsData as $operatorData) {
        $opratorAsObject = new TourOperator($operatorData);
        array_push($allOperatorsAsObjects, $opratorAsObject);
    }
    
    return $allOperatorsAsObjects; 
  }

  public function getTourOperatorScore(int $tour_operator_id){
    $query = $this->db->prepare(' SELECT AVG(value)
                                  FROM score
                                  WHERE tour_operator_id = :tour_operator_id');
    $query->execute(['tour_operator_id' => $tour_operator_id,]);
        
    $tourOperatorScore = $query->fetch(PDO::FETCH_ASSOC); 

    if ($tourOperatorScore['AVG(value)'] != 0){
      return intval($tourOperatorScore['AVG(value)']*10)/10;
    } else {
      return "aucune evaluation";
    }
  }

  public function getAllLocations(){
    $query = $this->db->query(' SELECT DISTINCT location
                                FROM destination
                                ORDER BY location');
    $allLocations = $query->fetchAll(PDO::FETCH_ASSOC); 
    
    $locationNames = array_column($allLocations, 'location');

    return $locationNames;
  }

  public function getDestinationsForLocation(string $location){
    $query = $this->db->prepare(' SELECT *
                                FROM destination
                                WHERE location = :location
                                ORDER BY id');
    $query->execute(['location' => $location,]);                            
    $allDestinationsDatas = $query->fetchAll(PDO::FETCH_ASSOC); 

    $allDestinationsAsObjects = [];        
    
    foreach ($allDestinationsDatas as $destinationDatas) {
        $destinationAsObject = new Destination($destinationDatas);
        array_push($allDestinationsAsObjects, $destinationAsObject);
    }
    
    return $allDestinationsAsObjects; 
  }

  public function getDestinationForTourOperator(string $location, int $tour_operator_id){
    $query = $this->db->prepare(' SELECT *
                                  FROM destination
                                  WHERE location = :location AND tour_operator_id = :tour_operator_id');
    $query->execute([ 'location' => $location,
                      'tour_operator_id' => $tour_operator_id]);                            
    $destination = new Destination($query->fetch(PDO::FETCH_ASSOC));

    return $destination;

  }

  public function getReviewsForTourOperator(int $tour_operator_id){
    $query = $this->db->prepare(' SELECT review.message, review.author_id, author.name
                                  FROM review
                                  INNER JOIN author
                                  ON review.author_id = author.id
                                  WHERE review.tour_operator_id = :tour_operator_id');
    $query->execute(['tour_operator_id' => $tour_operator_id,]);
        
    $allReviewsDatas = $query->fetchAll(PDO::FETCH_ASSOC); 

    $allReviewsAsObjects = [];        
        
    foreach ($allReviewsDatas as $reviewData) {
      $reviewAsObject = new Review($reviewData);
      array_push($allReviewsAsObjects, $reviewAsObject);
    }

    return $allReviewsAsObjects;
  }

  public function getUserReviewForOperator(int $author_id, int $tour_operator_id){
    $query = $this->db->prepare(' SELECT *
                                  FROM review
                                  WHERE author_id = :author_id AND tour_operator_id = :tour_operator_id');
    $query->execute([ 'tour_operator_id' => $tour_operator_id,
                      'author_id' => $author_id]);
        
    $review = $query->fetch(PDO::FETCH_ASSOC);

    return $review;
  }

  public function getUserByName(string $name){
    $query = $this->db->prepare('SELECT * FROM author WHERE LOWER(name) = :name ');
    $query->execute(['name' => strtolower($name)]);
    
    $userData = $query->fetch(); 

    if ($userData){
        $user = new Author($userData);
        return $user;
    }
    
  }

  public function getThreeRandomDestinations(){
    $query = $this->db->query(' SELECT *
                                FROM destination
                                JOIN tour_operator ON destination.tour_operator_id = tour_operator.id
                                WHERE tour_operator.premium_status = 1
                                ORDER BY RAND()
                                LIMIT 3');                         
    $allDestinationsDatas = $query->fetchAll(PDO::FETCH_ASSOC); 

    $allDestinationsAsObjects = [];        
    
    foreach ($allDestinationsDatas as $destinationDatas) {
        $destinationAsObject = new Destination($destinationDatas);
        array_push($allDestinationsAsObjects, $destinationAsObject);
    }
    
    return $allDestinationsAsObjects; 
  }

  public function updateOperatorDatas(array $operator_datas){
    $query = $this->db->prepare('   UPDATE tour_operator 
                                    SET name=:name, link=:link, premium_status=:premium_status
                                    WHERE id = :id');

    $query->execute([ 'id' => $operator_datas['update_operator_id'],
                      'name' => $operator_datas['name'],
                      'link' => $operator_datas['link'],
                      'premium_status' => $operator_datas['premium_status']]);
  }

  public function updateOperatorToPremium(int $tour_operator_id){
    $query = $this->db->prepare('   UPDATE tour_operator 
                                    SET premium_status = 1 
                                    WHERE id = :tour_operator_id');

    $query->execute(['tour_operator_id' => $tour_operator_id]);
  }

  public function deleteTourOperator(int $tour_operator_id){
    $query = $this->db->prepare(' DELETE FROM tour_operator 
                                  WHERE id = :tour_operator_id');
    $query->execute([   'tour_operator_id' => $tour_operator_id]); 
  }


  // SETTERS & GETTERS
  public function getDb(){
    return $this->db;
  }

  public function setDb($db){
    $this->db = $db;

    return $this;
  }
}