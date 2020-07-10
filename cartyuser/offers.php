<?php

include_once "database.php";
include_once "operations.php";

class offers extends database implements operations {

    var $offerId;var $offerTitle;var $offerShortDesc;var $offerDesc;var $offerStartDate;var $offerEndDate;

    // getter 

    public function getOfferId()
    {
        return $this->offerId;
    }
    public function getOfferTitle()
    {
       return $this->offerTitle;
    }
    public function getOfferShortDesc()
    {
        return $this->offerShortDesc;
    }
    public function getOfferDesc()
    {
        return $this->offerDesc;
    }
    public function getOfferStartDate()
    {
       return $this->offerStartDate;
    }
    public function getOfferEndDate()
    {
       return $this->offerEndDate;
    }

    // setter 

    public function setOfferId($id)
    {
        $this->offerId = $id;
    }
    public function setOfferTitle($t)
    {
        $this->offerTitle = $t;
    }
    public function setOfferShortDesc($d)
    {
        $this->offerShortDesc = $d;
    }
    public function setOfferDesc($d)
    {
        $this->offerDesc = $d;
    }
    public function setOfferStartDate($sd)
    {
        $this->offerStartDate = $sd;
    }
    public function setOfferEndDate($ed)
    {
        $this->offerEndDate = $ed;
    }



    /*
     */ 
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
        return parent::checkData("SELECT * FROM offers WHERE end_date > NOW()");

    }
    public function getNewOffers()
    {
        return parent::checkData("SELECT * FROM offers WHERE end_date > NOW() ORDER BY start_date DESC LIMIT 3");

    }
    public function getِAlmostDoneOffers()
    {
        return parent::checkData("SELECT * FROM offers WHERE end_date > NOW() ORDER BY end_date ASC LIMIT 5");

    }
    public function clients()
    {
        return parent::checkData("SELECT * FROM clients ORDER BY client_id LIMIT 5");

    }
   
}

?>