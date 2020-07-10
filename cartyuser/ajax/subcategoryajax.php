
<?php

if(isset($_POST["subcheck"])){
    
    include_once "../products.php";
    $prod=new products();
    $prod->setSubId($_POST["subcheck"]);
    $result=$prod->getsub();
    $output = '';  
  while ($row = mysqli_fetch_assoc($result)) 
  {
    $arrall[]=$row;
 $output .= '<div class="col-lg-4">
    <div class="product-slide_item"> 
        <div class="inner-slide">
            <div class="single-product">
                <div class="product-img">';
                    $prod->setProId($row['product_id']);
                    $prod->setSuppId($row['supplier_id']);
                    $pic1 = $prod->getSingleProductImages();
                    while ($rowimg1 = mysqli_fetch_assoc($pic1)) 
                    {
                        $output .='<a href="single-product-sale.php?pro='.$row['product_id'].'&supp='.$row['supplier_id'].'">';
                            if($rowimg1['status'] == 'primary')
                            {
                        $output .='<img class="primary-img" src="assets/images/product/large-size/'.$rowimg1['image_name'].'" alt="Urens Product Image">';
                            }
                            if($rowimg1['status'] == 'secondary')
                            {
                        $output .='<img class="secondary-img" src="assets/images/product/large-size/'.$rowimg1['image_name'].'" alt="Urens Product Image">';
                            }
                    $output .='</a>';
                    }
                    $output .='<div class="sticker">
                        <span class="sticker">New</span>
                    </div>
                    <div class="add-actions">
                        <ul>
                        <li><a class="uren-add_cart" href="cart.php?pro='.$row['product_id'].'&supp='.$row['supplier_id'].'" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="ion-bag"></i></a></li>

                            </li>
                            <li><a class="uren-wishlist" href="wishlist.php?pro='.$row['product_id'].'&supp='.$row['supplier_id'].'" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i
                                class="ion-android-favorite-outline"></i></a>
                            </li>
                            <li class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter'.$row['product_id'].';'.$row['supplier_id'].'"><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Quick View"><i
                                class="ion-android-open"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="product-content">
                    <div class="product-desc_info">
                    <div class="rating-box">
                        <ul>';
                       
                            $prod->setProId($row['product_id']);
                            $prod->setSuppId($row['supplier_id']);
                            $rate = $prod->getrating();
                            $r=0;
                            if($ratevalue=mysqli_fetch_assoc($rate))
                                $r=$ratevalue["average"];
                                for($x=0;$x<$r;$x++)
                                    {
                           
                                        $output .='<li><i class="ion-android-star"></i></li>';
                            
                                    }

                                    for($x=0;$x<5-$r;$x++){
                            
                                        $output .='<li class="silver-color"><i class="ion-android-star"></i></li>';
                        
                                    }
                            
                              
                            
                            
                            
                                    $output .= '</ul>
                    </div>
                        <h6><a class="product-name" href="single-product-sale.php?pro='.$row['product_id'].'&supp='.$row['supplier_id'].'">'.$row['name'].'</a></h6>
                        <div class="price-box">
                            <span class="new-price"><b> '.$row['price'].' EGP</b></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="list-slide_item">
        <div class="single-product">
            <div class="product-img">';
            $prod->setProId($row['product_id']);
            $prod->setSuppId($row['supplier_id']);
            $pic1 = $prod->getSingleProductImages();
            while ($rowimg1 = mysqli_fetch_assoc($pic1)) 
            {
                $output .='<a href="single-product-sale.php?pro='.$row['product_id'].'&supp='.$row['supplier_id'].'">';
                if($rowimg1['status'] == 'primary')
                {
            $output .='<img class="primary-img" src="assets/images/product/large-size/'.$rowimg1['image_name'].'" alt="Urens Product Image">';
                    }
                    if($rowimg1['status'] == 'secondary')
                    {
            $output .='<img class="secondary-img" src="assets/images/product/large-size/'.$rowimg1['image_name'].'" alt="Urens Product Image">';
                    }    
                    $output .='</a>';
                }
                    $output .='</div>
            <div class="product-content">
                <div class="product-desc_info">
                    <div class="rating-box">
                        <ul>
                            <li><i class="ion-android-star"></i></li>
                            <li><i class="ion-android-star"></i></li>
                            <li><i class="ion-android-star"></i></li>
                            <li class="silver-color"><i class="ion-android-star"></i>
                            </li>
                            <li class="silver-color"><i class="ion-android-star"></i>
                            </li>
                        </ul>
                    </div>
                    <h6><a class="product-name" href="single-product.html">'.$row['name'].'</a></h6>
                    <div class="price-box">
                        <span class="new-price"> <br>'.$row['price'].' EGP</b></span>
                    </div>
                    <div class="product-short_desc">
                        <p> '.$row['detials'].'</p>
                    </div>
                </div>
                <div class="add-actions">
                    <ul>
                        <li><a class="uren-add_cart" href="cart.php?pro='.$row['product_id'].'&supp='.$row['supplier_id'].'" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="ion-bag"></i></a>
                        </li>
                        <li><a class="uren-wishlist" href="wishlist.php?pro='.$row['product_id'].'&supp='.$row['supplier_id'].'" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i
                            class="ion-android-favorite-outline"></i></a>
                        </li>
                        
                        <li class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter"><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Quick View"><i
                            class="ion-android-open"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>';
                        } 
                        // foreach ($arrall as $row) {
                        //     $prod->setProId($row['product_id']);
                        //     $prod->setSuppId($row['supplier_id']);
                        //     include "../modal.php";
                        // }
                        echo $output;
                    }
                    
?>