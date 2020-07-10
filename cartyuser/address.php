<?php
include_once "operations.php";
include_once "database.php";
class address extends database implements operations  {
   
    var $addressId; var $id;var $city;var $address; var $area; var $buildno;  var $floorno; var $addstyp; var $addstatus; var $phone;
    // getter 
    public function getId(){
        return $this->id;
    }
    public function getaddressId(){
        return $this->addressId;
    }
    public function getcity(){
        return $this->city;
    }
    public function getstreet(){
        return $this->address;
    }
    public function getphone(){
        return $this->phone;
    }
   
    public function getarea(){
        return $this->area;
    }
    public function getbuildno(){
        return $this->buildno;
    }
    public function getfloorno(){
        return $this->floorno;
    }
    public function getstatus(){
        return $this->addstatus;
    }
    public function getaddstyp(){
        return $this->addstyp;
    }

    /* setter */
    public function setarea($id)
    {
       $this->area = $id;
    }
    public function setphone($id)
    {
       $this->phone = $id;
    }
    public function setbuildno($photoName)
    {
       $this->buildno = $photoName;
    }
    public function setfloorno($fn)
    {
       $this->floorno = $fn;
    }
    public function setaddstyp($fn)
    {
       $this->addstyp = $fn;
    }
    public function setId($id)
    {
       $this->id = $id;
    }
    public function setcity($photoName)
    {
       $this->city = $photoName;
    }
    public function setstreet($fn)
    {
       $this->address = $fn;
    }
    public function setaddressId($fn)
    {
       $this->addressId= $fn;
    }
    public function setstatus($fn)
    {
       $this->addstatus= $fn;
    }

    public function add(){

        // echo("INSERT INTO customeraddress(addressId,customer_id,phone,city_id,area,customerAddress,buildingNo,floorNo,addressType,addressStatus) values(default,".$this->getId().",".$this->getphone().",".$this->getcity().",'".$this->getarea()."','".$this->getstreet()."','".$this->getbuildno()."',".$this->getfloorno().",'".$this->getaddstyp()."','secondary')");
        return parent::checkData("INSERT INTO customeraddress(addressId,customer_id,phone,city_id,area,customerAddress,buildingNo,floorNo,addressType,addressStatus) values(default,".$this->getId().",".$this->getphone().",".$this->getcity().",'".$this->getarea()."','".$this->getstreet()."','".$this->getbuildno()."',".$this->getfloorno().",'".$this->getaddstyp()."','secondary')");
        
    }
    public function addFirstAdd(){

        // echo("INSERT INTO customeraddress(addressId,customer_id,phone,city_id,area,customerAddress,buildingNo,floorNo,addressType,addressStatus) values(default,".$this->getId().",".$this->getphone().",".$this->getcity().",'".$this->getarea()."','".$this->getstreet()."','".$this->getbuildno()."',".$this->getfloorno().",'".$this->getaddstyp()."','".$this->getstatus()."')");
        return parent::checkData("INSERT INTO customeraddress(addressId,customer_id,phone,city_id,area,customerAddress,buildingNo,floorNo,addressType,addressStatus) values(default,".$this->getId().",".$this->getphone().",".$this->getcity().",'".$this->getarea()."','".$this->getstreet()."','".$this->getbuildno()."',".$this->getfloorno().",'".$this->getaddstyp()."','".$this->getstatus()."')");
        
    }
    public function search(){
        
    }
    public function updateaddressstatus(){

        return parent::checkData("UPDATE customeraddress set addressStatus='".$this->getstatus()."' where addressId='".$this->getaddressId()."' ");

    }
    public function update(){
    //   echo("UPDATE  customeraddress SET city_id='".$this->getcity()."', area='".$this->getarea()."',customerAddress='".$this->getstreet()."',buildingNo='".$this->getbuildno()."',floorNo='".$this->getfloorno()."',addressType='".$this->getaddstyp()."', WHERE addressId='".$this->getId()."'");

        return parent::checkData("UPDATE  customeraddress SET city_id='".$this->getcity()."',phone='".$this->getphone()."', area='".$this->getarea()."',customerAddress='".$this->getstreet()."',buildingNo='".$this->getbuildno()."',floorNo='".$this->getfloorno()."',addressType='".$this->getaddstyp()."',floorNo='".$this->getfloorno()."' WHERE addressId='".$this->getId()."'");

    }
    public function getAddress()
    {
       return parent::checkData("SELECT * FROM view_profile WHERE addressId='".$this->getaddressId()."'");
    }
    
    public function getAll()
    {
       return parent::checkData("SELECT * FROM customeraddress WHERE customer_id ='".$this->getId()."'");
    }
    public function updateAllPrimary()
    {
       return parent::checkData("UPDATE  customeraddress set addressStatus ='secondary' WHERE customer_id ='".$this->getId()."'");
    }
    public function delete(){
        return parent::runDml("DELETE FROM customeraddress WHERE addressId='".$this->getaddressId()."'");
    }
    public function getProfile(){

        $select = parent::checkData("SELECT * FROM view_profile WHERE customer_id ='".$this->getId()."' ORDER BY addressStatus");
        
        return $select;
    }
    public function getaddressCheck(){
        // echo("SELECT * FROM view_profile WHERE (customer_id ='".$this->getId()."')and(addressStatus ='primary')");
        $select = parent::checkData("SELECT * FROM view_profile WHERE (customer_id ='".$this->getId()."')and(addressStatus ='primary')");
        
        return $select;
    }
    public function AddLoc($phone,$addType,$long,$lat,$customerID)
    {
        // echo("INSERT INTO `customeraddress` (`addressId`, `customer_id`, `phone`, `city_id`, `customerAddress`, `area`, `buildingNo`, `floorNo`, `addressType`, `addressStatus`, `lng`, `lat`) VALUES (NULL, '".$customerID."', '".$phone."', NULL, '', '', NULL, NULL, '".$addType."', '', '".$long."', '".$lat."')");

        return parent::runDml("INSERT INTO `customeraddress` (`addressId`, `customer_id`, `phone`, `city_id`, `customerAddress`, `area`, `buildingNo`, `floorNo`, `addressType`, `addressStatus`, `lng`, `lat`) VALUES (NULL, '".$customerID."', '".$phone."', NULL, '', '', NULL, NULL, '".$addType."', 'secondary', '".$long."', '".$lat."')");
       
    }

}

?>