<?php
ob_start();
session_start();

if(isset($_SESSION['username'])){
    include "headerafter.php";
}else{
    include "headerbefore.php";
}
 ?>

    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" style=" width:100%; height: 617px !important;">
            <?php
                include_once "offers.php";
                $off = new offers();
                $result = $off->getNewOffers();
                $active = 'active';
                $i=0;
                while($row = mysqli_fetch_assoc($result))
                    {
                     if($i == 0){
                                ?>
                <div class="carousel-item  <?php echo($active); ?>">
                    <?php
                        $i++;
                        }
                        else{
                    ?>
                        <div class="carousel-item">
                            <?php
                            }?>
                                <a href="allproducts.php?off=<?php echo($row['offer_id']) ?>"><img src="assets/images/slider/<?php echo($row['offer_photo_name']) ?>" class="d-block w-100" alt="<?php echo($row['offer_title']); ?>"></a>
                                <div class="carousel-caption d-none d-md-block" style="top:7%;">
                                    <div class="sliderContent text-center">
                                        <h3 class="sliderContentTitle"><?php $t =$row['offer_title']; $s= substr($t,0,34); echo($s); ?></h3>
                                        <h1 class="sliderContentShortDesc"><?php $sd =$row['offer_short_desc']; $ss= substr($sd,0,18); echo($ss); ?></h1>
                                        <p class="sliderContentDesc lead">
                                            <?php $des =$row['description']; $sss= substr($des,0,200); echo($sss.' ...'); ?>
                                        </p>
                                        <a class="btn btn-outline-warning back btn-offer" href="allproducts.php?off=<?php echo($row['offer_id']) ?>">Go shopping</a>
                                    </div>
                                </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                    <span class=""><i class="fas fa-angle-left carousel-control-prev-icon" aria-hidden="true"></i></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                    <span class=""><i class="fas fa-angle-right carousel-control-prev-icon" aria-hidden="true"></i></span>
                    <span class="sr-only">Next</span>
                </a>
        </div>
        <!-- Uren's Banner Two Area End Here -->

        <!-- Begin Uren's Shipping Area -->
        <div class="uren-shipping_area">
            <div class="container-fluid">
                <div class="shipping-nav">
                    <div class="row no-gutters">
                        <div class="shipping-grid">
                            <div class="shipping-item">
                                <div class="shipping-icon">
                                    <i class="ion-ios-paperplane-outline"></i>
                                </div>
                                <div class="shipping-content">
                                    <h6>Free Shipping</h6>
                                    <p>Free shipping on all US order</p>
                                </div>
                            </div>
                        </div>
                        <div class="shipping-grid">
                            <div class="shipping-item">
                                <div class="shipping-icon">
                                    <i class="ion-ios-help-outline"></i>
                                </div>
                                <div class="shipping-content">
                                    <h6>Support 24/7</h6>
                                    <p>Contact us 24 hours a day</p>
                                </div>
                            </div>
                        </div>
                        <div class="shipping-grid">
                            <div class="shipping-item">
                                <div class="shipping-icon">
                                    <i class="ion-ios-refresh-empty"></i>
                                </div>
                                <div class="shipping-content">
                                    <h6>100% Money Back</h6>
                                    <p>You have 30 days to Return</p>
                                </div>
                            </div>
                        </div>
                        <div class="shipping-grid">
                            <div class="shipping-item">
                                <div class="shipping-icon">
                                    <i class="ion-ios-undo-outline"></i>
                                </div>
                                <div class="shipping-content">
                                    <h6>90 Days Return</h6>
                                    <p>If goods have problems</p>
                                </div>
                            </div>
                        </div>
                        <div class="shipping-grid">
                            <div class="shipping-item">
                                <div class="shipping-icon">
                                    <i class="ion-ios-locked-outline"></i>
                                </div>
                                <div class="shipping-content last-child">
                                    <h6>Payment Secure</h6>
                                    <p>We ensure secure payment</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Uren's Shipping Area End Here -->

        <!-- Begin Featured Categories Area -->
        <div class="featured-categories_area featured-categories_area-2">
            <div class="container-fluid">
                <div class="section-title_area">
                    <span>Top Featured Collections</span>
                    <h3>Featured Categories</h3>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="featured-categories_slider-2 uren-slick-slider slider-navigation_style-1 img-hover-effect_area" data-slick-options='{
                        "slidesToShow": 6,
                        "arrows" : true
                       }' data-slick-responsive='[
                                             {"breakpoint":1501, "settings": {"slidesToShow": 5}},
                                             {"breakpoint":1200, "settings": {"slidesToShow": 4}},
                                             {"breakpoint":768, "settings": {"slidesToShow": 3}},
                                             {"breakpoint":576, "settings": {"slidesToShow": 2}},
                                             {"breakpoint":480, "settings": {"slidesToShow": 1}}
                                         ]'>
                            <?php
                                include_once "categories.php";
                                $cat = new categories();
                                $result = $cat->getPorCate();
                                while($row=mysqli_fetch_assoc($result))
                                {
                            ?>
                                <div class="slide-item">
                                    <div class="slide-inner">
                                        <div class="single-product">
                                            <div class="slide-image_area">
                                                <a href="allproducts.php?cate=<?php echo($row['category_id']) ?>">
                                                    <img src="assets/images/featured-categories/<?php echo($row['category_photo_name']) ?>" alt="Uren's Featured Categories">
                                                </a>
                                            </div>
                                            <div class="slide-content_area">
                                                <h3><a href="allproducts.php?cate=<?php echo($row['category_id']) ?>"><?php echo($row['category_name']) ?></a></h3>
                                                <span>(<?php echo($row['countPro']) ?> Products)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    }
                                ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Featured Categories Area End Here -->


        <!-- start sub  -->



        <!-- end sub  -->


        <!-- Begin Multiple Section Area -->
        <div class="multiple-section_area bg--white_smoke">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-3">
                        <div class="special-product_wrap img-hover-effect_area-2">
                            <div class="section-title_area bg--white">
                                <span>Special Offer Limited Time</span>
                                <h3>Deal Of The Day</h3>
                            </div>
                            <div class="special-product_slider-2 uren-slick-slider slider-navigation_style-1 img-hover-effect_area" data-slick-options='{
                        "slidesToShow": 1,
                        "arrows" : true
                        }' data-slick-responsive='[
                            {"breakpoint":1200, "settings": {"slidesToShow": 3}},
                            {"breakpoint":992, "settings": {"slidesToShow": 2}},
                            {"breakpoint":768, "settings": {"slidesToShow": 1}},
                            {"breakpoint":576, "settings": {"slidesToShow": 1}}
                        ]'>

                                <?php

                                include_once "products.php";
                                $pro = new products();
                                $result5 = $pro->getِAlMostEndProducts();
                                $arrdeal = [];
                                while($row= mysqli_fetch_assoc($result5))
                                {
                                    $arrdeal[]=$row;
                                    $pro->setProId($row['product_id']);
                                    $pro->setSuppId($row['supplier_id']);
                                ?>

                                    <div class="slide-item">
                                        <div class="inner-slide">
                                            <div class="single-product">
                                                <div class="product-img">
                                                    <?php
                                                     $pic1 = $pro->getSingleProductImages();
                                                     while ($rows = mysqli_fetch_assoc($pic1))
                                                     {
                                                    ?>
                                                        <a href="single-product-sale.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id']) ?>&end=<?php echo($row['end_date']) ?>">
                                                            <?php
                                                        if($rows['status'] == 'primary')
                                                        {
                                                    ?>
                                                                <img class="primary-img" src="assets/images/product/large-size/<?php echo($rows['image_name']) ?>" alt="Uren's Product Thumnail">
                                                                <?php
                                                            }
                                                            if($rows['status'] == 'secondary')
                                                            {
                                                        ?>
                                                                    <img class="secondary-img" src="assets/images/product/large-size/<?php echo($rows['image_name']) ?>" alt="Uren's Product Thumnail">
                                                                    <?php
                                                            }?>

                                                        </a>
                                                        <?php
                                                        }
                                                        ?>
                                                            <div class="sticker-area-2">
                                                                <span class="sticker-2"><?php echo(($row['percentage']+$row['discount'])*100 . ' %') ?></span>
                                                                <!-- <span class="sticker">New</span> -->
                                                            </div>
                                                </div>
                                                <div class="product-content">
                                                    <div class="product-desc_info">
                                                        <div class="uren-countdown_area">
                                                            <span class="product-offer">Hurry up! Offer ends in:</span>
                                                            <div class="countdown-wrap">
                                                                <div class="countdown item-4" data-countdown="<?php echo($row['end_date']) ?>" data-format="short">
                                                                    <div class="countdown__item">
                                                                        <span class="countdown__time daysLeft"></span>
                                                                        <span class="countdown__text daysText"></span>
                                                                    </div>
                                                                    <div class="countdown__item">
                                                                        <span class="countdown__time hoursLeft"></span>
                                                                        <span class="countdown__text hoursText"></span>
                                                                    </div>
                                                                    <div class="countdown__item">
                                                                        <span class="countdown__time minsLeft"></span>
                                                                        <span class="countdown__text minsText"></span>
                                                                    </div>
                                                                    <div class="countdown__item">
                                                                        <span class="countdown__time secsLeft"></span>
                                                                        <span class="countdown__text secsText"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="rating-box">
                                                            <ul>
                                                                <?php

                                                                $rate = $pro->getrating();
                                                                $r=0;
                                                                if($ratevalue=mysqli_fetch_assoc($rate))
                                                                    $r=$ratevalue['average'];
                                                                    for($x=0;$x<$r;$x++)
                                                                        {
                                                                ?>
                                                                    <li><i class="ion-android-star"></i></li>
                                                                    <?php
                                                                }

																        for($x=0;$x<5-$r;$x++)
																            {
																?>
                                                                        <li class="silver-color"><i class="ion-android-star"></i></li>
                                                                        <?php
                                                                }

                                                                    ?>
                                                            </ul>
                                                        </div>
                                                        <h6 class="product-name"><a href="single-product.php?pro"><?php echo($row['name']); ?></a></h6>
                                                        <div class="price-box">
                                                            <span class="new-price new-price-2"><?php $old=$row['price'];$totalDisc = $row['percentage'] +$row['discount'];$discount= $totalDisc*$row['price'];$new = round($new = $old-$discount,2); echo($new.' EGP'); ?></span>
                                                            <span class="old-price"><?php echo($row['price'].' EGP') ?></span>
                                                        </div>
                                                        <div class="add-actions">
                                                            <ul>
                                                                <li><a class="uren-add_cart" href="cart.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id'])?>" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i
                                                                class="ion-bag"></i>Add To Cart</a>
                                                                </li>
                                                                <li><a class="uren-wishlist" href="wishlist.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id'])?>" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i
                                                                class="ion-android-favorite-outline"></i></a>
                                                                </li>
                                                                <li class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter<?php echo($row['product_id']);echo($row['supplier_id']) ?>"><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Quick View"><i
                                                                class="ion-android-open"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <!-- modal deal  -->
                    <?php
                        foreach ($arrdeal as $value) {
                            $pro->setProId($value['product_id']);
                            $pro->setSuppId($value['supplier_id']);
                            include "modal.php";
                        }
                        ?>
                        <div class="col-xl-9">
                            <div class="row">
                                <div class="col-xl-4">
                                    <div class="list-product_wrap img-hover-effect_area-2 bg--white">
                                        <div class="section-title_area bg--white">
                                            <span>Most Recent Products on this week</span>
                                            <h3>Most Recent Products</h3>
                                        </div>
                                        <div class="list-product_slider uren-slick-slider slider-navigation_style-1 section-space_mn-30 img-hover-effect_area" data-slick-options='{
                                "slidesToShow": 1,
                                "arrows" : true,
                                "rows": 4
                               }' data-slick-responsive='[
                                    {"breakpoint":1501, "settings": {"slidesToShow": 1}},
                                    {"breakpoint":1200, "settings": {"slidesToShow": 2}},
                                    {"breakpoint":768, "settings": {"slidesToShow": 1}}
                               ]'>
                                            <?php
                                    include_once "products.php";
                                    $pro = new products();
                                    $result4 = $pro->getNewProducts();
                                    $arrRecent = [];
                                    while($row = mysqli_fetch_assoc($result4)){
                                        $arrRecent[] = $row;

                                        $pro->setProId($row['product_id']);
                                        $pro->setSuppId($row['supplier_id']);

                                    ?>
                                                <div class="slide-item">
                                                    <div class="inner-slide">
                                                        <div class="single-product">
                                                            <div class="product-img">
                                                                <div class="sticker">
                                                                    <span class="sticker">New</span>
                                                                </div>
                                                                <?php
                                                $result8 = $pro->getSingleProductImages();
                                                while($rows8 = mysqli_fetch_assoc($result8))
                                                {

                                                ?>
                                                    <a href="single-product-sale.php?pro=<?php echo($row['product_id']); ?>&supp=<?php  echo($row['supplier_id']); ?>">

                                                <?php
                                                    if($rows8['status']=='primary')
                                                    {

                                                    ?>
                                                                            <img src="assets/images/product/large-size/<?php echo($rows8['image_name']) ?>" alt="Uren's Product Image">
                                                                            <?php
                                                    }
                                                }
                                                    ?>
                                                                    </a>
                                                                    <!-- <div class="sticker">
                                                    <span class="sticker-2">New</span>
                                                </div> -->

                                                            </div>
                                                            <div class="product-content">
                                                                <div class="rating-box">
                                                                    <ul>
                                                                        <?php
                                                        $rate = $pro->getrating();
                                                        $r=0;
                                                        if($ratevalue=mysqli_fetch_assoc($rate))
                                                            $r=$ratevalue['average'];
                                                            for($x=0;$x<$r;$x++)
                                                                {
                                                        ?>
                                                                            <li><i class="ion-android-star"></i></li>
                                                                            <?php
                                                        }

                                                                for($x=0;$x<5-$r;$x++)
                                                                    {
                                                        ?>
                                                                                <li class="silver-color"><i class="ion-android-star"></i></li>
                                                                                <?php
                                                        }

                                                            ?>
                                                                    </ul>
                                                                </div>
                                                                <h3 class="product-name">
                                                    <a href="shop-left-sidebar.html"><?php echo($row['name']) ?></a>
                                                </h3>
                                                                <div class="price-box">
                                                                    <span class="new-price"><?php echo($row['price']) ?></span>
                                                                </div>
                                                                <div class="add-actions" id="glglAct">
                                                                    <ul id="glglUl">
                                                                        <li id="glglLi"><a id="glglA" class="uren-add_cart" href="cart.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id'])?>" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i id="glglI" class="ion-bag"></i></a>
                                                                        </li>
                                                                        <li id="glglLi"><a id="glglA" class="uren-wishlist" href="wishlist.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id'])?>" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i id="glglI"  class="ion-android-favorite-outline"></i></a>
                                                                        </li>
                                                                        <li class="quick-view-btn"><a id="glglA" href="javascript:void(0)" data-toggle="modal" data-target="#exampleModalCenter<?php echo($row['product_id']);echo($row['supplier_id']) ?>"><i id="glglI" class="ion-android-open"></i></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                        }
                                    ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- modal resect product -->
                                <?php
                            foreach($arrRecent as $value)
                            {
                                $pro->setProId($value['product_id']);
                                $pro->setSuppId($value['supplier_id']);
                                include "modal.php";
                            }
                            ?>
                                    <div class="col-xl-4">
                                        <div class="list-product_wrap img-hover-effect_area-2 bg--white">
                                            <div class="section-title_area bg--white">
                                                <span>Most View On This Week</span>
                                                <h3>Most View Products</h3>
                                            </div>
                                            <div class="list-product_slider uren-slick-slider slider-navigation_style-1 section-space_mn-30 img-hover-effect_area" data-slick-options='{
                                "slidesToShow": 1,
                                "arrows" : true,
                                "rows": 4
                               }' data-slick-responsive='[
                                    {"breakpoint":1501, "settings": {"slidesToShow": 1}},
                                    {"breakpoint":1200, "settings": {"slidesToShow": 2}},
                                    {"breakpoint":768, "settings": {"slidesToShow": 1}}
                                                 ]'>
                                                <?php
                                        include_once "products.php";
                                        $pro = new products();
                                        $resg = $pro->getِMostview();
                                        $arrmost=[];
                                        while($row = mysqli_fetch_assoc($resg))
                                        {
                                            $arrmost[]=$row;
                                        ?>
                                                    <div class="slide-item">
                                                        <div class="inner-slide">
                                                            <div class="single-product">
                                                                <div class="product-img">
                                                                    <?php
                                                        $pro->setProId($row['product_id']);
                                                        $pro->setSuppId($row['supplier_id']);
                                                        $result7 = $pro->getSingleProductImages();
                                                        while($rows = mysqli_fetch_assoc($result7))
                                                        {
                                                        ?>
                                                                        <a href="single-product-sale.php?pro=<?php echo($row['product_id']); ?>&supp=<?php echo($row['supplier_id']); ?>">

                                                                            <?php
                                                            if($rows['status']=='primary')
                                                            {
                                                        ?>
                                                                                <img src="assets/images/product/large-size/<?php echo($rows['image_name']) ?>" alt="Uren's Product Image">
                                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                                        </a>
                                                                </div>
                                                                <div class="product-content">
                                                                    <div class="rating-box">
                                                                        <ul>
                                                                            <?php
                                                                $rate = $pro->getrating();
                                                                $r=0;
                                                                if($ratevalue=mysqli_fetch_assoc($rate))
                                                                    $r=$ratevalue['average'];
                                                                    for($x=0;$x<$r;$x++)
                                                                        {
                                                                ?>
                                                                                <li><i class="ion-android-star"></i></li>
                                                                                <?php
                                                                }
                                                                    for($x=0;$x<5-$r;$x++)
                                                                        {
																?>
                                                                                    <li class="silver-color"><i class="ion-android-star"></i></li>
                                                                                    <?php
                                                                }
                                                                    ?>
                                                                        </ul>
                                                                    </div>
                                                                    <h3 class="product-name">
                                                            <a href="shop-left-sidebar.html"><?php echo($row['name'])?></a>
                                                        </h3>
                                                                    <div class="price-box">
                                                                        <span class="new-price"><?php echo($row['price'])?></span>
                                                                    </div>
                                                                    <div class="add-actions" id="glglAct">
                                                                        <ul id="glglUl">
                                                                            <li id="glglLi"><a id="glglA" class="uren-add_cart" href="cart.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id'])?>" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i id="glglI" class="ion-bag"></i></a>
                                                                            </li>
                                                                            <li id="glglLi"><a id="glglA" class="uren-wishlist" href="wishlist.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id'])?>" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i id="glglI"  class="ion-android-favorite-outline"></i></a>
                                                                            </li>
                                                                            <li id="glglLi" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter<?php echo($row['product_id']);echo($row['supplier_id']) ?>"><a id="glglA" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Quick View"><i id="glglI"  class="ion-android-open"></i></a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                    } ?>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- modal of most viewed product -->
                                    <?php
                                foreach($arrmost as $value){
                                    $pro->setProId($value['product_id']);
                                    $pro->setSuppId($value['supplier_id']);
                                    include "modal.php";
                                }
                            ?>
                                        <div class="col-xl-4">
                                            <div class="list-product_wrap img-hover-effect_area-2 bg--white">
                                                <div class="section-title_area bg--white">
                                                    <span>On-Sale On This Week</span>
                                                    <h3>On-Sale Products</h3>
                                                </div>
                                                <div class="list-product_slider uren-slick-slider slider-navigation_style-1 img-hover-effect_area" data-slick-options='{
                                "slidesToShow": 1,
                                "arrows" : true,
                                "rows": 4
                               }' data-slick-responsive='[
                                    {"breakpoint":1501, "settings": {"slidesToShow": 1}},
                                    {"breakpoint":1200, "settings": {"slidesToShow": 2}},
                                    {"breakpoint":768, "settings": {"slidesToShow": 1}}
                                                 ]'>
                                                    <?php
                                        include_once "products.php";
                                        $pro = new products();
                                        $result3 = $pro->getِMostSaledProducts();
                                        $arrsale=[];
                                        while($row = mysqli_fetch_assoc($result3))
                                        {
                                        $arrsale[]=$row;
                                        $pro->setProId($row['product_id']);
                                        $pro->setSuppId($row['supplier_id']);
                                        ?>
                                                        <div class="slide-item">
                                                            <div class="inner-slide">
                                                                <div class="single-product">
                                                                    <div class="product-img">
                                                                        <?php
                                                    $result7 = $pro->getSingleProductImages();
                                                    while($rows = mysqli_fetch_assoc($result7))
                                                    {
                                                    ?>
                                                    <a href="single-product-sale.php?pro=<?php echo($row['product_id']); ?>&supp=<?php echo($row['supplier_id']); ?>">

                                                    <?php
                                                        if($rows['status']=='primary')
                                                        {
                                                        ?>
                                                        <img src="assets/images/product/large-size/<?php echo($rows['image_name']) ?>" alt="Uren's Product Image">
                                                        <?php
                                                        }
                                                    }
                                                        ?>
                                                        </a>
                                                                    </div>
                                                                    <div class="product-content">
                                                                        <div class="rating-box">
                                                                            <ul>

                                                                                <?php
                                                            $rate = $pro->getrating();
                                                            $r=0;
                                                            if($ratevalue=mysqli_fetch_assoc($rate))
                                                                $r=$ratevalue['average'];
                                                                for($x=0;$x<$r;$x++)
                                                                    {
                                                            ?>
                                                                                    <li><i class="ion-android-star"></i></li>
                                                                                    <?php
                                                            }

                                                                    for($x=0;$x<5-$r;$x++)
                                                                        {
                                                            ?>
                                                                                        <li class="silver-color"><i class="ion-android-star"></i></li>
                                                                                        <?php
                                                            }

                                                                ?>
                                                                            </ul>
                                                                        </div>
                                                                        <h3 class="product-name">
                                                        <a  href="single-product-sale.php?pro=<?php echo($row['product_id']); ?>&supp=<?php echo($row['supplier_id']); ?>"><?php echo($row['name']); ?></a>
                                                    </h3>
                                                                        <div class="price-box">
                                                                            <span class="new-price"><?php echo($row['price'].' EGP'); ?></span>
                                                                        </div>
                                                                        <div class="add-actions" id="glglAct">
                                                                            <ul id="glglUl">
                                                                                <li id="glglLi"><a id="glglA" class="uren-add_cart" href="cart.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id'])?>" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i id="glglI" class="ion-bag"></i></a>
                                                                                </li>
                                                                                <li id="glglLi"><a id="glglA" class="uren-wishlist" href="wishlist.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id'])?>" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i id="glglI"  class="ion-android-favorite-outline"></i></a>
                                                                                </li>
                                                                                <li id="glglLi" class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter<?php echo($row['product_id']);echo($row['supplier_id']) ?>"><a id="glglA" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Quick View"><i id="glglI"  class="ion-android-open"></i></a></li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php
                                         }
                                        ?>
                                                </div>
                                            </div>
                                        </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <!-- modal sale product -->
        <?php
            foreach($arrsale as $value){
                $pro->setProId($value['product_id']);
                $pro->setSuppId($value['supplier_id']);
                include "modal.php";
            }
        ?>
            <!-- Multiple Section Area End Here -->

            <!-- Begin Uren's Product Area -->
            <div class="uren-product_area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section-title_area">
                                <span>Top New Offers in This Week</span>
                                <h3>Products With Offers</h3>
                            </div>
                            <?php
                        include_once "products.php";
                        $pro = new products();
                        $result6 = $pro->getofferedproduct();
                        ?>
                                <div class="product-slider uren-slick-slider slider-navigation_style-1 img-hover-effect_area" data-slick-options='{
                        "slidesToShow": 6,
                        "arrows" : true
                        }' data-slick-responsive='[
                                                {"breakpoint":1501, "settings": {"slidesToShow": 4}},
                                                {"breakpoint":1200, "settings": {"slidesToShow": 3}},
                                                {"breakpoint":992, "settings": {"slidesToShow": 2}},
                                                {"breakpoint":767, "settings": {"slidesToShow": 1}},
                                                {"breakpoint":480, "settings": {"slidesToShow": 1}}
                                            ]'>
                                    <?php
                                $arr = [];
                                while($row = mysqli_fetch_assoc($result6))
                                {
                                    $arr[]=$row;
                                    $pro->setProId($row['product_id']);
                                    $pro->setSuppId($row['supplier_id']);
                            ?>
                                        <div class="product-slide_item">
                                            <div class="inner-slide">
                                                <div class="single-product">
                                                    <div class="product-img">
                                                        <?php
                                                $result8 = $pro->getSingleProductImages();
                                                while($rows8 = mysqli_fetch_assoc($result8))
                                                {

                                                ?>
                                                            <a href="single-product-sale.php?pro=<?php echo($row['product_id']); ?>&supp=<?php  echo($row['supplier_id']); ?>">

                                                                <?php
                                                    if($rows8['status'] == 'primary')
                                                        {
                                                ?>
                                                                    <img class="primary-img" src="assets/images/product/large-size/<?php echo($rows8['image_name']) ?>" alt="Uren's Product Image">
                                                                    <?php
                                                        }
                                                    if($rows8['status'] == 'secondary')
                                                        {
                                                ?>
                                                                        <img class="secondary-img" src="assets/images/product/large-size/<?php echo($rows8['image_name']) ?>" alt="Uren's Product Image">
                                                                        <?php
                                                        }
                                                ?>
                                                            </a>
                                                            <?php
                                                        }
                                                ?>
                                                                <div class="sticker-area-2">
                                                                    <span class="sticker-2"><?php echo($row['discount']*100 . ' %') ?></span>
                                                                </div>
                                                                <div class="add-actions">
                                                                    <ul>
                                                                        <li><a class="uren-add_cart" href="cart.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id'])?>" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="ion-bag"></i></a>
                                                                        </li>
                                                                        <li><a class="uren-wishlist" href="wishlist.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id'])?>" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i class="ion-android-favorite-outline"></i></a>
                                                                        </li>

                                                                        </li>
                                                                        <li class="quick-view-btn"><a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModalCenter<?php echo($row['product_id']);echo($row['supplier_id']) ?>"><i class="ion-android-open"></i></a></li>
                                                                    </ul>
                                                                </div>
                                                    </div>
                                                    <div class="product-content">
                                                        <div class="product-desc_info">
                                                            <div class="rating-box">
                                                                <ul>
                                                                    <?php
                                                                $rate = $pro->getrating();
                                                                $r=0;
                                                                if($ratevalue=mysqli_fetch_assoc($rate))
                                                                {
                                                                    $r=$ratevalue['average'];
                                                                    for($x=0;$x<$r;$x++)
                                                                        {
                                                                ?>
                                                                        <li><i class="ion-android-star"></i></li>
                                                                        <?php
                                                                        }
                                                                    for($x=0;$x<5-$r;$x++)
                                                                        {
																?>
                                                                            <li class="silver-color"><i class="ion-android-star"></i></li>
                                                                            <?php
                                                                        }
                                                                }
                                                            ?>
                                                                </ul>
                                                            </div>
                                                            <h6><a class="product-name" href="single-product-sale.php?pro=<?php echo($row['product_id']); ?>&supp=<?php echo($row['supplier_id']); ?>"><?php echo($row['name']) ?></a></h6>
                                                            <div class="price-box">
                                                                <span class="new-price new-price-2"><?php $old=$row['price'];$discount= $row['discount']*$row['price'];$new = round($new = $old-$discount,2); echo($new.' EGP'); ?></span>
                                                                <span class="old-price"><?php echo($row['price'].' EGP') ?></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <?php
                            }
                           ?>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal of offered product -->
            <?php
        foreach($arr as $value)
        {
                $pro->setProId($value['product_id']);
                $pro->setSuppId($value['supplier_id']);
                include "modal.php";
        }
        ?>

                <!-- Uren's Product Area End Here -->
                <?php  //print_r($arr) ?>
                    <div id="carouselExampleCaptions1" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <?php
                        include_once "offers.php";
                        $off = new offers();
                        $result = $off->clients();
                        $active = 'active';
                        $i=0;
                        while($row = mysqli_fetch_assoc($result))
                        {
                            if($i == 0){
                    ?>
                                <div class="carousel-item  <?php echo($active); ?>">
                                    <?php
                            $i++;
                            }else{
                        ?>
                                        <div class="carousel-item">
                                            <?php
                            }
                            ?>
                                                <img src="assets/images/testimonial/bg-1.jpg" class="d-block w-100" alt="<?php echo($row['client_name']); ?>">
                                                <div class="client_photo_div">
                                                    <img class="client_photo" src="assets/images/testimonial/user/<?php echo($row['client_photo']) ?>" alt="<?php echo($row['client_name']);?>" titlle="<?php echo($row['client_name']);?>">
                                                </div>
                                                <div class="carousel-caption d-none d-md-block">
                                                    <div class="sliderContent text-center" style="position: absolute;bottom: 10%;">
                                                        <h1 class="display-3 text-light"><?php $sd =$row['client_name'];  echo($sd); ?></h1>
                                                        <p class="sliderContentDesc lead">
                                                            <?php $des =$row['client_comment']; $sss= substr($des,0,300); echo($sss.' ...'); ?>
                                                        </p>
                                                    </div>
                                                </div>
                                        </div>
                                        <?php
                        }
                        ?>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleCaptions1" role="button" data-slide="prev">
                                    <span class=""><i class="fas fa-angle-left carousel-control-prev-icon" aria-hidden="true"></i></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleCaptions1" role="button" data-slide="next">
                                    <span class=""><i class="fas fa-angle-right carousel-control-prev-icon" aria-hidden="true"></i></span>
                                    <span class="sr-only">Next</span>
                                </a>
                        </div>

                        <!-- Begin Uren's Brand Area -->
                        <div class="uren-brand_area">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="section-title_area">
                                            <span>Top Quality Partner</span>
                                            <h3>Shop By Brands</h3>
                                        </div>
                                        <div class="brand-slider uren-slick-slider img-hover-effect_area" data-slick-options='{
                                "slidesToShow": 6
                                }' data-slick-responsive='[
                                                {"breakpoint":1200, "settings": {"slidesToShow": 5}},
                                                {"breakpoint":992, "settings": {"slidesToShow": 3}},
                                                {"breakpoint":767, "settings": {"slidesToShow": 3}},
                                                {"breakpoint":577, "settings": {"slidesToShow": 2}},
                                                {"breakpoint":321, "settings": {"slidesToShow": 1}}
                                            ]'>
                                            <?php
                                            include "brand.php";
                                            $brand = new brand;
                                            $br =$brand->getAll();
                                            while($rowbr = mysqli_fetch_assoc($br))
                                            {
                                        ?>
                                                <div class="slide-item">
                                                    <div class="inner-slide">
                                                        <div class="single-product">
                                                            <a href="allproducts.php?brand_id=<?php echo($rowbr['brand_id']) ?>">
                                            <img width="170px" height="150px" src="assets/images/brand/<?php echo($rowbr['brand_image'])?>" alt="<?php echo($rowbr['brand_name'])?>"
                                            title="<?php echo($rowbr['brand_name'])?>">
                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                }
                                ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Uren's Brand Area End Here -->

                        <div class="featured-categories_area featured-categories_area-2">
                            <div class="container-fluid">
                                <div class="section-title_area">
                                    <span>Top Featured Collections Of Subcategory</span>
                                    <h3>Featured Subcategory</h3>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="featured-categories_slider-2 uren-slick-slider slider-navigation_style-1 img-hover-effect_area" data-slick-options='{
                                        "slidesToShow": 6,
                                        "arrows" : true
                                    }' data-slick-responsive='[
                                                            {"breakpoint":1501, "settings": {"slidesToShow": 5}},
                                                            {"breakpoint":1200, "settings": {"slidesToShow": 4}},
                                                            {"breakpoint":768, "settings": {"slidesToShow": 3}},
                                                            {"breakpoint":576, "settings": {"slidesToShow": 2}},
                                                            {"breakpoint":480, "settings": {"slidesToShow": 1}}
                                                        ]'>
                                            <?php
                                                include_once "categories.php";
                                                $subcat = new categories();
                                                $ressub = $subcat->getfeaturesubcat();
                                                while($row_sub=mysqli_fetch_assoc($ressub))
                                                {
                                            ?>
                                                <div class="slide-item">
                                                    <div class="slide-inner">
                                                        <div class="single-product">
                                                            <div class="slide-image_area">
                                                                <a href="allproducts.php?cate=<?php echo($row_sub['category_id']) ?>&sub=<?php echo($row_sub['sub_cate_id']) ?>">
                                                                    <img src="assets/images/sub-categories/<?php echo($row_sub['subcategory_photo']) ?>" alt="<?php echo($row_sub['sub_cate_name']) ?>">
                                                                </a>
                                                            </div>
                                                            <div class="slide-content_area">
                                                                <h3><a href="allproducts.php?cate=<?php echo($row_sub['category_id']) ?>&sub=<?php echo($row_sub['sub_cate_id']) ?>"><?php echo($row_sub['sub_cate_name']) ?></a></h3>
                                                                <span>(<?php echo($row_sub['countsubpro']) ?> Products)</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                    }
                                                ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Begin Uren's Footer Area -->

                        <?php include "footer.php"; ?>
                            <!-- <script>
    $('.carousel').carousel({
    interval: 6000
    });
</script> -->
