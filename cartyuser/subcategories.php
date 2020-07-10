<?php

include_once "database.php";
include_once "operations.php";

class subcategories extends database implements operations {

    var $subCateId;var $subCateName;

    // getter 

    public function getSubCateId()
    {
        return $this->subCateId;
    }
    public function getSubCateName()
    {
       return $this->subCateName;
    }

    // setter 

    public function setSubCateId($id)
    {
        $this->subCateId = $id;
    }
    public function setSubCateName($n)
    {
        $this->subCateName = $n;
    }

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
        return parent::checkData("SELECT * FROM sub_categories");
    }
    public function getEachSub($id)
    {
        return parent::checkData("SELECT *  FROM sub_categories WHERE category_id =".$id);
    }
    

}

?>