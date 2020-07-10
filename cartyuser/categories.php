<?php

include_once "database.php";
include_once "operations.php";

class categories extends database implements operations {

    var $cateId;var $cateName;var $subId;

    // getter

    public function getCateId()
    {
        return $this->cateId;
    }
    public function getCateName()
    {
       return $this->cateName;
    }
    public function getSubId()
    {
       return $this->subId;
    }

    // setter
    public function setSubId($sb)
    {
        $this->subId=$sb;
    }
    public function setCateId($id)
    {
        $this->cateId = $id;
    }
    public function setCateName($n)
    {
        $this->cateName = $n;
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
        return parent::checkData("SELECT * FROM categories  ORDER BY category_name");
    }
    public function getPorCate()
    {
        return parent::checkData("SELECT * FROM view_featured_category  ORDER BY countPro DESC");
    }
    public function getsub()
    {
    //    echo ("SELECT * FROM sub_categories WHERE  category_id=".$this->getCateId()."");
        return parent::checkData("SELECT * FROM sub_categories WHERE  category_id=".$this->getCateId()."");

    }
    public  function getfeaturesubcat(){

        return parent::checkData("SELECT *, COUNT(product_id) AS countsubpro FROM feature_sub_cat GROUP BY sub_cate_id LIMIT 12");
    }
}
