<?php

include_once "database.php";
include_once "operations.php";

class temp_wishlist extends database implements operations {

    var $proId;var $suppId;var $userId;var $proName;var $quantity;var $price;
    // getter 
    public function getProId()
    {
        return $this->proId;
    }
    public function getSuppId()
    {
       return $this->suppId;
    }
    public function getUserId()
    {
       return $this->userId;
    }
    public function getProName()
    {
       return $this->proName;
    }
    public function getQantity()
    {
       return $this->quantity;
    }
    
    public function getPrice()
    {
       return $this->price;
    }
    // setter 
    public function setProId($p)
    {
        $this->proId=$p;
    }
    public function setSuppId($s)
    {
        $this->suppId=$s;
    }
    public function setUserId($ui)
    {
        $this->userId=$ui;
    }
    public function setProName($pr)
    {
        $this->proName=$pr;
    }
    public function setQuantity($q)
    {
        $this->quantity=$q;
    }
    public function setPrice($pi)
    {
        $this->price=$pi;
    }
   
    public function add(){
        return parent::checkData("INSERT INTO temp_wishlist VALUES ('".$this->getProId()."','".$this->getSuppId()."','".$this->getUserId()."','".$this->getProName()."','".$this->getQantity()."','".$this->getPrice()."')");
    }
    public function search(){

    }
    public function update(){
        // echo("UPDATE temp_cart SET quantity='".$this->getQantity()."' WHERE (product_id='".$this->getProId()."' AND supplier_id='".$this->getSuppId()."' AND user_id='".$this->getUserId()."')");
        return parent::checkData("UPDATE temp_wishlist SET quantity = 1 WHERE product_id = ".$this->getProId()." AND supplier_id = ".$this->getSuppId()." AND user_id = ".$this->getUserId()."");

    }
    public function delete(){
        return parent::checkData("DELETE FROM temp_wishlist WHERE (product_id='".$this->getProId()."' AND supplier_id='".$this->getSuppId()."' AND user_id='".$this->getUserId()."')");

    }
    public function getAll()
    {
        return parent::checkData("SELECT * FROM view_wish WHERE user_id='".$this->getUserId()."'");

    }

   

   
}

?>