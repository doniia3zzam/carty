<?php
include_once "operations.php";
include_once "database.php";
class customer extends database implements operations  {

    var $id;var $fName;var $lName;var $email;var $city;var $street;var $password;var $status;var $date;var $photoName;
    // var $phone;

    // getter
    public function getId(){
        return $this->id;
    }
    public function getPhotoName(){
        return $this->photoName;
    }
    public function getFName(){
        return $this->fName;
    }
    public function getLName(){
        return $this->lName;
    }
    public function getEmail(){
        return $this->email;
    }
    // public function getPhone(){
    //     return $this->phone;
    // }
    public function getCity(){
        return $this->city;
    }
    public function getStreet(){
        return $this->street;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getStatus(){
        return $this->status;
    }
    public function getDate(){
        return $this->date;
    }

    // setter
    public function setId($id)
    {
       $this->id = $id;
    }
    public function setPhotoName($photoName)
    {
       $this->photoName = $photoName;
    }
    public function setFName($fn)
    {
       $this->fName = $fn;
    }
    public function setLName($ln)
    {
       $this->lName = $ln;
    }
    public function setEmail($e)
    {
       $this->email = $e;
    }
    // public function setphone($ph)
    // {
    //    $this->phone = $ph;
    // }
    public function setCity($c)
    {
       $this->city = $c;
    }
    public function setStreet($s)
    {
       $this->street = $s;
    }

    public function setPassword($p)
    {
       $this->password = $p;
    }

    // we dont neeet to set this

    // public function setdate($fn)
    // {
    //    $this->date = $fn;
    // }
    // public function setstatus($fn)
    // {
    //    $this->status = $fn;
    // }


    public function add(){
        return parent::runDml("INSERT INTO customers(first_name,last_name,email,password) VALUES('".$this->getFName()."','".$this->getLName()."','".$this->getEmail()."','".$this->getPassword()."')");
    }
    public function search(){

    }
    public function update(){
        return parent::runDml("UPDATE  customers SET password ='".$this->getPassword()."' WHERE customer_id ='".$this->getId()."'");

    }

    public function updateProfile(){
        // echo("UPDATE customers SET  first_name ='".$this->getFName()."', last_name='".$this->getLName()."', phone='".$this->getPhone()."', email='".$this->getEmail()."', city='".$this->getCity()."', street='".$this->getStreet()."' WHERE customer_id='".$this->getId()."'");
        return parent::runDml("UPDATE customers SET  first_name ='".$this->getFName()."', last_name='".$this->getLName()."', phone='".$this->getPhone()."', email='".$this->getEmail()."' ,photo_name='".$this->getPhotoName()."' WHERE customer_id='".$this->getId()."'");
    }

    public function delete(){
        return parent::runDml("DELETE FROM customers WHERE customer_id='".$this->getId()."'");
    }
    public function getAll()
    {

       return parent::checkData("SELECT * FROM customers WHERE customer_id='".$this->getId()."'");
    }
    public function login(){
        // echo("SELECT * FROM customers WHERE(email='".$this->getEmail()."' OR phone='".$this->getPhone()."') AND password = '".$this->getPassword()."'");
        $select = parent::checkData("SELECT * FROM customers WHERE(email='".$this->getEmail()."') AND password = '".$this->getPassword()."'");
        return $select;
    }
    public function checkEmail(){

        $select = parent::checkData("SELECT * FROM customers WHERE email='".$this->getEmail()."'");


        return $select;
    }
    public function checkPass(){

        $select = parent::checkData("SELECT * FROM customers WHERE password='".$this->getPassword()."' AND customer_id ='".$this->getId()."'");


        return $select;
    }

    public function getaddress(){

        $select = parent::checkData("SELECT * FROM view_profile WHERE (customer_id ='".$this->getId()."')and(addressStatus ='primary')");
        // echo("SELECT * FROM view_customer_profile WHERE customer_id ='".$this->getId()."'");

        return $select;
    }
    public function getProfile(){
    //    echo("SELECT * FROM view_profile WHERE customer_id ='".$this->getId()."'");

       return parent::checkData("SELECT * FROM view_profile WHERE customer_id ='".$this->getId()."' ORDER BY addressStatus ASC");
    }
    public function lastCustId()
    {
       return parent::lastId();
    }

    public function checkEmailajax($email)
    {
       return parent::checkData("SELECT email FROM customers WHERE email='".$email."'");
    }
    public function getimage($img,$custID)
    {
        return parent::runDml("UPDATE customers SET photo_name='".$img."' WHERE customer_id ='".$custID."' ");
    }
    // public function fnEncrypt($sValue, $sSecretKey)
    // {
    //     return rtrim(
    //         base64_encode(
    //             mcrypt_encrypt(
    //                 MCRYPT_RIJNDAEL_256,
    //                 $sSecretKey, $sValue,
    //                 MCRYPT_MODE_ECB,
    //                 mcrypt_create_iv(
    //                     mcrypt_get_iv_size(
    //                         MCRYPT_RIJNDAEL_256,
    //                         MCRYPT_MODE_ECB
    //                     ),
    //                     MCRYPT_RAND)
    //                 )
    //             ), "\0"
    //         );
    // }

// fnDecrypt
// function fnDecrypt($sValue, $sSecretKey)
// {
//     return rtrim(
//         mcrypt_decrypt(
//             MCRYPT_RIJNDAEL_256,
//             $sSecretKey,
//             base64_decode($sValue),
//             MCRYPT_MODE_ECB,
//             mcrypt_create_iv(
//                 mcrypt_get_iv_size(
//                     MCRYPT_RIJNDAEL_256,
//                     MCRYPT_MODE_ECB
//                 ),
//                 MCRYPT_RAND
//             )
//         ), "\0"
//     );
// }

}

?>
