<?php
include_once "operations.php";
include_once "database.php";
class order extends database implements operations  {
    var $customerId;
    var $delivaryId;
    var $total;
    var $paymentId;
    var $orderId;var $proId;var $suppId;var $price;var $quantity;
    var $rateValue;
    var $comment;
    var $lastRateId;

 

 // ******************
    // getter 
    public function getLastRateId(){
        return $this->lastRateId;
    }
    public function getcustomerId(){
        return $this->customerId;
    }
    public function getdelivaryId(){
        return $this->delivaryId;
    }
    public function gettotal(){
        return $this->total;
    }
    public function getpaymentId(){
        return $this->paymentId;
    }
    public function getOrderId(){
        return $this->orderId;
    }
    public function getProId(){
        return $this->proId;
    }
    public function getSuppId(){
        return $this->suppId;
    }
    public function getPrice(){
        return $this->price;
    }
    public function getQuantity(){
        return $this->quantity;
    }
    public function getrateValue()
    {
        return $this->rateValue;
    }

    public function getcomment()
    {
        return $this->comment;
    }

    // setter 
    public function setLastRateId($R)
    {
       $this->lastRateId = $R;
    }
    public function setcustomerId($cu_id)
    {
       $this->customerId = $cu_id;
    }
    public function setdelivaryId($de_id)
    {
       $this->delivaryId = $de_id;
    }
    public function settotal($p)
    {
       $this->total = $p;
    }
    public function setpaymentId($pay_id)
    {
       $this->paymentId = $pay_id;
    }
    public function setOrderId($or_id)
    {
       $this->orderId = $or_id;
    }
    public function setProId($pro)
    {
       $this->proId = $pro;
    }
    public function setSuppId($sup)
    {
       $this->suppId = $sup;
    }
    public function setPrice($p)
    {
       $this->price = $p;
    }
    public function setQuantity($q)
    {
       $this->quantity = $q;
    }
    public function setcomment($p)
    {
       $this->comment=$p;
    }
    public function setrateValue($p)
    {
        $this->rateValue=$p;
    }



    public function add(){
        
    }
    public function search(){
        
    }
    public function update(){

    }
    public function delete(){
        return parent::runDml("DELETE FROM orders WHERE order_id = '".$this->getOrderId()."'");
    }
    public function getAll()
    {
       return parent::checkData("SELECT * FROM orders");

    }
    public function setOrder()
    {
        // echo("INSERT INTO orders(customer_id,delivery_id,payment_id,total) VALUES ('".$this->getcustomerId()."','".$this->getdelivaryId()."','".$this->getpaymentId()."','".$this->gettotal()."')");
        return parent::runDml("INSERT INTO orders (customer_id,delivery_id,payment_id,total) 
        VALUES ('".$this->getcustomerId()."','".$this->getdelivaryId()."','".$this->getpaymentId()."','".$this->gettotal()."')");

    }
    public function setProducts()
    {
        // echo("INSERT INTO ordered_products (order_id,product_id,supplier_id,price,quantity) VALUES ('".$this->getOrderId()."','".$this->getProId()."','".$this->getSuppId()."','".$this->getPrice()."','".$this->getQuantity()."')");
        return parent::runDml("INSERT INTO ordered_products (order_id,product_id,supplier_id,price,quantity) 
        VALUES ('".$this->getOrderId()."','".$this->getProId()."','".$this->getSuppId()."','".$this->getPrice()."','".$this->getQuantity()."')");
    }
    public function getLastId()
    {
        return parent::lastId();
    }
    public function myOrders()
    {
        return parent::checkData("SELECT DISTINCT COUNT(product_id) AS countPro, order_id,date,status,total FROM view_my_order WHERE customer_id = '".$this->getcustomerId()."' GROUP BY order_id,date,status ORDER BY date DESC");
    }
    public function myOrderProducts()
    {
        return parent::checkData("SELECT product_id,supplier_id,name,quantity,price,total,status FROM view_my_order WHERE order_id = '".$this->getOrderId()."'");
    }
    public function setRate(){
       
        return parent::runDml("INSERT INTO rating (comment,value) values ('".$this->getcomment()."','".$this->getrateValue()."')");
    }
    public function setOrderedRate()
    {
        return parent::runDml("UPDATE ordered_products SET rating_id = '".$this->getLastRateId()."' WHERE product_id = '".$this->getProId()."'
        AND supplier_id = '".$this->getSuppId()."' AND order_id = '".$this->getOrderId()."'");
    }

    // QR Code function
    public function showOrder()
    {

        return parent::checkData("SELECT * FROM view_my_order WHERE order_id = '".$this->getOrderId()."'");
    }

}

?>