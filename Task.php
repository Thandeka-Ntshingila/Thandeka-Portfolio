<?php
class Task {
    private $id;
    private $description;
    private $completed;
    
    public function __construct($description, $completed = false, $id = null) {
      $this->description = $description;
      $this->completed = $completed;
      $this->id = $id;
      
    }
    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }
    public function getDescription() {
        return $this->description;
    }
    public function setDescription($description) {
        $this->description = $description;
    }
    public function isCompleted() {
        return $this->completed;
    }
    public function setCompleted($completed) {
        $this->completed = $completed;
    }
}
?>

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

