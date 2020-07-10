<?php

include_once "database.php";
include_once "operations.php";

class products extends database implements operations {

    var $proId;var $suppId;var $cateId;var $subId;Var $search;var $proname;var $brand;var $offer;var $imageName;var $imageStatus;var $limit;var $record;
    // getter
    public function  getrecord()
    {
        return $this->record;
    }
    public function getlimit()
    {
        return $this->limit;
    }
    public function getProId()
    {
        return $this->proId;
    }
    public function getImageName()
    {
        return $this->imageName;
    }
    public function getImageStatus()
    {
        return $this->imageStatus;
    }
    public function getSuppId()
    {
       return $this->suppId;
    }
    public function getCateId()
    {
       return $this->cateId;
    }
    public function getSubId()
    {
       return $this->subId;
    }
    public function getSearch()
    {
        return $this->search;
    }

    public function getproname()
    {
        return $this->proname;
    }
    public function getBrand()
    {
        return $this->brand;
    }
    public function getOffer()
    {
        return $this->offer;
    }
    // setter
    public function setrecord($p)
    {
        $this->record=$p;
    }
    public function setlimit($p)
    {
        $this->limit=$p;
    }
    public function setProId($p)
    {
        $this->proId=$p;
    }
    public function setImageName($i)
    {
        $this->imageName=$i;
    }
    public function setImageStatus($st)
    {
        $this->imageStatus=$st;
    }
    public function setSuppId($s)
    {
        $this->suppId=$s;
    }
    public function setSubId($sb)
    {
        $this->subId=$sb;
    }
    public function setCateId($ct)
    {
        $this->cateId=$ct;
    }
    public function setSearch($search)
    {
        $this->search=$search;
    }
    public function setproname($n)
    {
        $this->proname=$n;
    }
    public function setBrand($b)
    {
        $this->brand=$b;
    }
    public function setOffer($o)
    {
        $this->offer=$o;
    }



    /*
     */
    public function add(){

    }
    public function search(){

    }

    public function delete(){

    }
    public function getAll()
    {
    }
    public function getAllProducts($all)
    {
        if($all == 0 )
            return parent::checkData("SELECT * FROM view_all_products LIMIT ".$this->getlimit().",".$this->getrecord()."");
        return parent::checkData("SELECT * FROM view_all_products");
    }
    public function getAllWithCate($all)
    {
        if($all == 0){

            // echo("SELECT * FROM view_all_products WHERE category_id='".$this->getCateId()."'  LIMIT ".$this->getlimit().",".$this->getrecord()." ");
            return parent::checkData("SELECT * FROM view_all_products WHERE category_id='".$this->getCateId()."'  LIMIT ".$this->getlimit().",".$this->getrecord()." ");
        }else{
            return parent::checkData("SELECT * FROM view_all_products WHERE category_id='".$this->getCateId()."'");
        }
    }
    public function getAllWithCateAndSub($all)
    {
        if($all == 0){
             // echo("SELECT * FROM view_all_products WHERE (category_id='".$this->getCateId()."' AND sub_cate_id='".$this->getSubId()."') ORDER BY category_id AND sub_cate_id DESC LIMIT '".$this->getlimit()."','".$this->getrecord()."' ");
            return parent::checkData("SELECT * FROM view_all_products WHERE (category_id='".$this->getCateId()."' AND sub_cate_id='".$this->getSubId()."') ORDER BY category_id AND sub_cate_id DESC LIMIT ".$this->getlimit().",".$this->getrecord()." ");
        }else{
            return parent::checkData("SELECT * FROM view_all_products WHERE (category_id='".$this->getCateId()."' AND sub_cate_id='".$this->getSubId()."') ORDER BY category_id AND sub_cate_id DESC  ");
        }

    }
    public function getNewProducts()
    {
        return parent::checkData("SELECT * FROM view_most_recent_products LIMIT 12");

    }
    public function getِMostSaledProducts()
    {
        return parent::checkData("SELECT * FROM view_most_saled_products LIMIT 12");

    }
    public function getِAlMostEndProducts()
    {
        return parent::checkData("SELECT * FROM view_almost_end_products LIMIT 5");

    }
    public function getNewArrivalProducts()
    {
        return parent::checkData("SELECT * FROM view_new_arrival_products");
    }
    public function getSingleProduct()
    {
        // echo("SELECT * FROM view_single_product WHERE product_id =".$this->getProId()." AND supplier_id =".$this->getSuppId()."");
        return parent::checkData("SELECT * FROM view_single_product WHERE product_id =".$this->getProId()." AND supplier_id =".$this->getSuppId()."");

    }
    public function getSingleProductImages()
    {
        // echo("SELECT * FROM view_products_images WHERE product_id =".$this->getProId()." AND supplier_id =".$this->getSuppId()."");
        return parent::checkData("SELECT * FROM view_products_images WHERE product_id =".$this->getProId()." AND supplier_id =".$this->getSuppId()."");

    }
    // public function getSingleImage()
    // {
    //     echo("SELECT * FROM view_products_images WHERE product_id =".$this->getProId()." AND supplier_id =".$this->getSuppId()."");
    //     return parent::checkData("SELECT * FROM view_products_images WHERE image_name='".$this->getProId().$this->getSuppId().jpg."'");

    // }

    public function getِMostview()
    {
        return parent::checkData("SELECT * FROM view_most_viewed LIMIT 12");
        //s7

    }
    //update views yomnna
    public function update(){

        // echo("update products set views+=1 WHERE product_id='".$this->getProId()."' AND supplier_id='".$this->getSuppId()."'");
        return parent::RunDML("UPDATE products SET views = views+1 WHERE product_id='".$this->getProId()."' AND supplier_id='".$this->getSuppId()."'");
    }
    // search galal
    public function searchAjax()
    {

       return parent::checkData("SELECT * FROM products WHERE name LIKE '%".$this->getSearch()."%' LIMIT 10");
    }
    public function searchAll($all)
    {
        if($all == 0)
            return parent::checkData("SELECT * FROM products WHERE name LIKE '%".$this->getSearch()."%' LIMIT ".$this->getlimit().",".$this->getrecord()." ");
        return parent::checkData("SELECT * FROM products WHERE name LIKE '%".$this->getSearch()."%' ");

    }
    // related an similar hadeer
    public function relatedProducts()
    {
        echo("SELECT * FROM view_all_products where sub_cate_id ='".$this->getSubId()."'");
        return parent::checkData("SELECT * FROM view_all_products where sub_cate_id ='".$this->getSubId()."'");
        //  return parent::checkData("SELECT * FROM products where sub_cate_id = (SELECT sub_cate_id FROM products WHERE product_id = ".$this->getProId().")");

    }

    public function similarProducts()
    {
        // echo("SELECT * FROM view_all_products WHERE name LIKE '%".$this->getproname()."%' AND sub_cate_id = '".$this->getSubId()."' ");
         return parent::checkData("SELECT * FROM view_all_products WHERE name LIKE '%".$this->getproname()."%' AND sub_cate_id = '".$this->getSubId()."' ");

    }
    //mtnsesh t5de setter w getter bto3 $proname
   public function brandProducts($all)
   {
        if($all == 0)
            return parent::checkData("SELECT * FROM `view_all_products` WHERE brand_id = '".$this->getBrand()."' LIMIT ".$this->getlimit().",".$this->getrecord()." ");
        return parent::checkData("SELECT * FROM `view_all_products` WHERE brand_id = '".$this->getBrand()."'");


   }

   //mtnsesh t5de setter w getter bto3 $proname
   public function offeredProducts($all)
   {
        if($all == 0)
            return parent::checkData("SELECT * FROM `view_offered_products` WHERE offer_id = '".$this->getOffer()."' ORDER BY percentage DESC  LIMIT ".$this->getlimit().",".$this->getrecord()."");
        return parent::checkData("SELECT * FROM `view_offered_products` WHERE offer_id = '".$this->getOffer()."' ORDER BY percentage DESC");

   }
   public function getNewArrivalProductsImages()
   {
       return parent::checkData("SELECT image_name,status FROM view_new_arrival_products WHERE product_id='".$this->getProId()."' AND supplier_id='".$this->getSuppId()."'");
   }
   //average ating doniaa
   public function getrating(){
    // echo("SELECT round(avg(value)) AS average ,product_id ,supplier_id from product_rating WHERE product_id ='".$this->getProId()."' AND supplier_id ='".$this->getSuppId()."' GROUP BY product_id ,supplier_id");
    return parent::checkData("SELECT round(avg(value)) AS average ,product_id ,supplier_id from product_rating WHERE product_id ='".$this->getProId()."' AND supplier_id ='".$this->getSuppId()."' GROUP BY product_id ,supplier_id");
    }
    public function getreview(){
        // echo("SELECT round(avg(value)) AS average ,product_id ,supplier_id from product_rating WHERE product_id ='".$this->getProId()."' AND supplier_id ='".$this->getSuppId()."' GROUP BY product_id ,supplier_id");
        return parent::checkData("SELECT * from view_rating_customer WHERE product_id ='".$this->getProId()."' AND supplier_id ='".$this->getSuppId()."'");
        }

    // specifications
    public function getspecifications()
    {
        return parent::checkData("SELECT * FROM specifications WHERE product_id ='".$this->getProId()."' AND supplier_id ='".$this->getSuppId()."'");
    }
    //offered products
    public function getofferedproduct()
    {
        // echo("SELECT * FROM view_all_products WHERE (category_id=".$this->getCateId()."AND sub_cate_id=".$this->getSubId().")");
        return parent::checkData("SELECT * FROM view_all_products  ORDER BY discount DESC LIMIT 12");

    }




    /*--------------------------------------------------------------------------------------------- */
    public function addImages()
    {
        return parent::runDml("INSERT INTO products_images(product_id, supplier_id, image_name, status) VALUES ('".$this->getProId()."','".$this->getSuppId()."'),'".$this->getImageName()."','".$this->getImageStatus()."' ");
    }
    // sorting shaimaa
    public function showAtoZ($n)
    {
        // echo("SELECT * FROM view_all_products WHERE (category_id=".$this->getCateId()."AND sub_cate_id=".$this->getSubId().")");
        return parent::checkData("SELECT * FROM view_all_products  order by name limit $n");

    }
    public function showZtoA($n)
    {
        // echo("SELECT * FROM view_all_products WHERE (category_id=".$this->getCateId()."AND sub_cate_id=".$this->getSubId().")");
        return parent::checkData("SELECT * FROM view_all_products  order by name desc limit $n");

    }
    public function showlow($n)
    {
        // echo("SELECT * FROM view_all_products WHERE (category_id=".$this->getCateId()."AND sub_cate_id=".$this->getSubId().")");
        return parent::checkData("SELECT * FROM view_all_products  order by price limit $n");

    }
    public function showhigh($n)
    {
        // echo("SELECT * FROM view_all_products WHERE (category_id=".$this->getCateId()."AND sub_cate_id=".$this->getSubId().")");
        return parent::checkData("SELECT * FROM view_all_products  order by price desc limit $n");
    }
    public function showModelAtoZ($n)
    {
        // echo("SELECT * FROM view_all_products WHERE (category_id=".$this->getCateId()."AND sub_cate_id=".$this->getSubId().")");
        return parent::checkData("SELECT * FROM view_all_products  order by model_name limit $n");

    }
    public function showModelZtoA($n)
    {
        // echo("SELECT * FROM view_all_products WHERE (category_id=".$this->getCateId()."AND sub_cate_id=".$this->getSubId().")");
        return parent::checkData("SELECT * FROM view_all_products  order by model_name desc limit $n");

    }
    public function getsub()
    {
    //    echo ("SELECT * FROM view_all_products WHERE  sub_cate_id=".$this->getSubId()."");
        return parent::checkData("SELECT * FROM view_all_products WHERE  sub_cate_id=".$this->getSubId()."");

    }
}

?>
