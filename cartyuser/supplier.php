
<?php
include_once "operations.php";
include_once "database.php";
class supplier extends database implements operations  {

   var $suppId;
   var $name;
   var $phone;
   var $email;
   var $street;
   var $password;
   var $shopName;
   var $details;
   var $buildingNo;
   var $area;
   var $city;
   var $opentime;
   var $endtime;
   var $dayoff;

    // get suppId
    public function getsuppId(){
        return $this->suppId;
    }
    // set suppId
    public function setsuppId($s)
    {
       $this->suppId = $s;
    }
    
    // get supp name
    public function getname(){
        return $this->name;
    }
    // set supp name
    public function setname($s)
    {
       $this->name = $s;
    }
    
   // get supp phone
    public function getphone(){
    return $this->phone;
    }
    // set supp phone
    public function setphone($s)
    {
    $this->phone = $s;
    }

    // get supp email
    public function getemail(){
    return $this->email;
    }
    // set supp email
    public function setemail($s)
    {
    $this->email = $s;
    }

     // get supp street
    public function getstreet(){
    return $this->street;
    }
    // set supp street
    public function setstreet($s)
    {
    $this->street = $s;
    }

     // get supp password
    public function getpassword(){
    return $this->password;
    }
    // set supp password
    public function setpassword($s)
    {
    $this->password = $s;
    }

     // get supp shopName
    public function getshopName(){
    return $this->shopName;
    }
    // set supp shopName
    public function setshopName($s)
    {
    $this->shopName = $s;
    }

     // get supp details
    public function getdetails(){
    return $this->details;
    }
    // set supp details
    public function setdetails($s)
    {
    $this->details = $s;
    }

     // get supp buildingNo
    public function getbuildingNo(){
    return $this->buildingNo;
    }
    // set supp buildingNo
    public function setbuildingNo($s)
    {
    $this->buildingNo = $s;
    }

     // get supp area
    public function getarea(){
    return $this->area;
    }
    // set supp area
    public function setarea($s)
    {
    $this->area = $s;
    }

    // get supp city
    public function getcity(){
    return $this->city;
    }
    // set supp city
    public function setcity($s)
    {
    $this->city = $s;
    }

    // get supp opentime
    public function getopentime(){
    return $this->opentime;
    }
    // set supp opentime
    public function setopentime($s)
    {
    $this->opentime = $s;
    }

    // get supp endtime
    public function getendtime(){
    return $this->endtime;
    }
    // set supp endtime
    public function setendtime($s)
    {
    $this->endtime = $s;
    }

    
    

    
    
    // ****************

    public function add(){
        return parent::runDml("INSERT INTO suppliers (supplier_name,shop_name,email,password,details,open_time,close_time) VALUES
        ('".$this->getname()."','".$this->getshopName()."','".$this->getemail()."','".$this->getpassword()."','".$this->getdetails()."','".$this->getopentime()."','".$this->getendtime()."') ");

    }
    public function search(){
        
    }
    public function update(){

    }
    public function delete(){

    }
    public function getAll()
    {
    //    return parent::checkData("SELECT * FROM cities");
    }
    
    public function getsupplierscities()
    {
       return parent::runDml("INSERT INTO suppliers_lives (supplier_id,city_id,supplier_phone,supplier_area,supplier_street,supplier_bulding_no) VALUES
       ('".$this->getsuppId()."','".$this->getcity()."','".$this->getphone()."','".$this->getarea()."','".$this->getstreet()."','".$this->getbuildingNo()."') ");
    }
    
    public function lastSuppId()
    {
       return parent::lastId();
    }
    public function checkEmail($email)
    {
       return parent::checkData("SELECT email FROM suppliers WHERE email='".$email."'");
    }

}

?>

