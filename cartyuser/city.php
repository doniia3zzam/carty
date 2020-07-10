<?php
include_once "operations.php";
include_once "database.php";
class city extends database implements operations  {
   
    

    public function add(){
        
    }
    public function search(){
        
    }
    public function update(){

    }
    public function delete(){

    }
    public function getAll()
    {
       return parent::checkData("SELECT * FROM cities");
    }

}

?>