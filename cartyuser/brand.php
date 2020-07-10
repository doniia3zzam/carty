<?php

include_once "database.php";
include_once "operations.php";

class brand extends database implements operations {


    // functions
    public function add(){}
    public function search(){}
    public function update(){}
    public function delete(){}

    public function getAll(){
        return parent::checkData("SELECT * FROM brands LIMIT 6");
    }
}
?>
