<?php

include_once "database.php";
include_once "operations.php";

class temp_cart extends database implements operations {

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
    /*
     */ 
    public function add(){
        return parent::checkData("INSERT INTO `temp_cart` (`product_id`, `supplier_id`, `user_id`, `product_name`, `quantity`, `price`)  VALUES ('".$this->getProId()."','".$this->getSuppId()."','".$this->getUserId()."','".$this->getProName()."','".$this->getQantity()."','".$this->getPrice()."')");
    }
    public function search(){

    }
    public function update(){
        // echo("UPDATE temp_cart SET quantity='".$this->getQantity()."' WHERE (product_id='".$this->getProId()."' AND supplier_id='".$this->getSuppId()."' AND user_id='".$this->getUserId()."')");
        return parent::checkData("UPDATE temp_cart SET quantity = quantity+'".$this->getQantity()."' WHERE product_id = ".$this->getProId()." AND supplier_id = ".$this->getSuppId()." AND user_id = ".$this->getUserId()."");

    }
    public function delete(){
        return parent::checkData("DELETE FROM temp_cart WHERE (product_id='".$this->getProId()."' AND supplier_id='".$this->getSuppId()."' AND user_id='".$this->getUserId()."')");

    }
    public function getAll()
    {
        return parent::checkData("SELECT * FROM temp_cart WHERE user_id='".$this->getUserId()."'");

    }
    public function getCount()
    {
        // echo("SELECT COUNT(*) AS cartCount FROM temp_cart WHERE user_id='".$this->getUserId()."'");
        return parent::checkData("SELECT COUNT(*) AS cartCount FROM temp_cart WHERE user_id='".$this->getUserId()."'");

    }
    public function removeMyCart($userid)
    {
       return parent::runDml("DELETE FROM temp_cart WHERE user_id = '".$userid."'");
    }
    public function updateqty(){
        // echo("UPDATE temp_cart SET quantity = '".$this->getQantity()."' WHERE product_id = ".$this->getProId()." AND supplier_id = ".$this->getSuppId()." AND user_id = ".$this->getUserId()."");

        return parent::runDml("UPDATE temp_cart SET quantity = '".$this->getQantity()."' WHERE product_id = ".$this->getProId()." AND supplier_id = ".$this->getSuppId()." AND user_id = ".$this->getUserId()."");
    }

   
}

?>