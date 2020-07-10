<?php
ob_start();
session_start();
if(isset($_SESSION['username'])){
    include "headerafter.php";
}else{
    include "headerbefore.php";
    } ?>

        <!-- Begin Uren's Breadcrumb Area -->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="breadcrumb-content">
                    <h2>Single Product Type</h2>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li class="active">Single Product Sale</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Uren's Breadcrumb Area End Here -->

        <!-- Begin Uren's Single Product Sale Area -->
        <div class="sp-area">
            <div class="container-fluid">
                <div class="sp-nav">
                    <div class="row">
                        <?php
                            include_once "products.php";
                            $single = new products();
                            $single->setProId($_GET['pro']);
                            $single->setSuppId($_GET['supp']);
                            $result = $single->getSingleProduct();
                            $result2 = $single->update();
                            // echo($result);
                            if($rows= mysqli_fetch_assoc($result))
                            {
                        ?>
                        <div class="col-lg-4">
                            <div class="sp-img_area">
                                <div class="sp-img_slider slick-img-slider uren-slick-slider" data-slick-options='{
                                "slidesToShow": 1,
                                "arrows": false,
                                "fade": true,
                                "draggable": false,
                                "swipe": false,
                                "asNavFor": ".sp-img_slider-nav"
                                }'>
                                <?php
                                    $resultt2 = $single->getSingleProductImages();
                                    while ($row = mysqli_fetch_assoc($resultt2)) {
                                ?>
                                    <!-- <div style="height:450px;overflow:hidden">                              -->
                                    <div class="single-slide red zoom">
                                        <?php
                                            if($row['status'] == 'primary')
                                            {
                                        ?>
                                        <img src="../public/assets/images/products/<?php echo($row['image_name']) ?>" alt="Uren's Product Image">
                                        <?php
                                            }
                                            if($row['status'] == 'secondary')
                                            {
                                        ?>
                                        <img src="../public/assets/images/products/<?php echo($row['image_name']) ?>" alt="Uren's Product Image">
                                        <?php
                                            }
                                            if($row['status'] == 'others')
                                            {
                                        ?>
                                        <img src="../public/assets/images/products/<?php echo($row['image_name']) ?>" alt="Uren's Product Image">
                                        <?php
                                            }
                                        ?>
                                    </div>
                                    <!-- </div>  -->

                                    <?php
                                    }
                                ?>
                                </div>

                                <div class="sp-img_slider-nav slick-slider-nav uren-slick-slider slider-navigation_style-3" data-slick-options='{
                                        "slidesToShow": 3,
                                        "asNavFor": ".sp-img_slider",
                                        "focusOnSelect": true,
                                        "arrows" : true,
                                        "spaceBetween": 30
                                    }' data-slick-responsive='[
                                            {"breakpoint":1501, "settings": {"slidesToShow": 3}},
                                            {"breakpoint":992, "settings": {"slidesToShow": 4}},
                                            {"breakpoint":768, "settings": {"slidesToShow": 3}},
                                            {"breakpoint":575, "settings": {"slidesToShow": 2}}
                                        ]'>
                                        <?php
                                    $resultt2 = $single->getSingleProductImages();
                                    while ($row = mysqli_fetch_assoc($resultt2))
                                    {
                                ?>
                                    <div class="single-slide red">
                                    <?php
                                            if($row['status'] == 'primary')
                                            {
                                        ?>
                                        <img src="../public/assets/images/products/<?php echo($row['image_name']) ?>" alt="Uren's Product Thumnail">
                                        <?php
                                            }
                                            if($row['status'] == 'secondary')
                                            {
                                        ?>
                                        <img src="../public/assets/images/products/<?php echo($row['image_name']) ?>" alt="Uren's Product Thumnail">
                                         <?php
                                            }
                                            if($row['status'] == 'others')
                                            {
                                        ?>
                                        <img src="../public/assets/images/products/<?php echo($row['image_name']) ?>" alt="Uren's Product Thumnail">
                                        <?php
                                            }
                                        ?>
                                    </div>


                                    <?php
                                    }
                                ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="sp-content">
                                <div class="sp-heading">
                                    <h5><?php echo($rows['name']) ?></h5>
                                </div>
                                <span class="reference"><a href=""><?php echo($rows['sub_cate_name']) ?></a></span>
                                <div class="rating-box">
                                    <ul>
                                        <?php
                                            $rate = $single->getrating();
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
                                <div class="sp-essential_stuff">
                                    <ul>
                                        <li>Brand <a href="javascript:void(0)"><?php echo($rows['brand_name']) ?></a></li>
                                        <li>Model <a href="javascript:void(0)"><?php echo($rows['model_name']) ?></a></li>
                                        <li>Product Code: <a href="javascript:void(0)"><?php echo($rows['product_id'].$rows['supplier_id']) ?></a></li>
                                        <!-- <li>Reward Points: <a href="javascript:void(0)">100</a></li> -->
                                        <?php
                                        if($rows['stock_quantity']>0){
                                            ?>
                                            <li>Availability: <a href="javascript:void(0)">In Stock</a></li>
                                            <?php
                                        }else{
                                            ?>
                                            <li style="text-decoration: line-through;text-decoration-color: red;">Availability: <a href="javascript:void(0)" style="text-decoration: line-through;text-decoration-color: red;">Out of stock</a></li>
                                            <?php
                                        }
                                        ?>

                                    </ul>
                                </div>

                                <?php
                                if(isset($_GET['end'])){


                                ?>
                                <div class="countdown-wrap">
                                    <div class="countdown item-4" data-countdown="<?php if(isset($_GET['end'])){  echo($_GET['end']);} else{} ?>" data-format="short">
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
                                <?php
                                }
                                ?>
                                <form method="post">
                                <div class="quantity">
                                    <label>Quantity</label>
                                    <div class="cart-plus-minus">
                                        <input class="cart-plus-minus-box" value="1" name="quantity" type="number">
                                        <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                        <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                    </div>
                                </div>

                                <div class="qty-btn_area">
                                    <ul>
                                        <li><button type="submit" name="addToCart" class="addToCart" value="Add To Cart" >Add To Cart</button></li>
                                        <li><a class="qty-wishlist_btn" href="wishlist.php?pro=<?php echo($rows['product_id']) ?>&supp=<?php echo($rows['supplier_id'])?>" data-toggle="tooltip" title="Add To Wishlist"><i class="ion-android-favorite-outline"></i></a>
                                        </li>
                                    </ul>
                                </div>
                                <?php
                                if (isset($_POST['addToCart'])) {

                                    include_once "temp_cart.php";
                                    $cart = new temp_cart();
                                    $cart->setProId($_GET['pro']);
                                    $cart->setSuppId($_GET['supp']);
                                    $cart->setUserId($_SESSION['userid']);
                                    $cart->setQuantity($_POST['quantity']);
                                    $cart->setProName($rows['name']);
                                    $cart->setPrice($rows['price']);
                                    $response = $cart->add();

                                    if($response != 'ok'){
                                        $response1 = $cart->update();
                                    }


                                }
                                ?>
                                </form>
                                <div class="uren-tag-line">
                                    <h6>Tags:</h6>
                                    <a href="javascript:void(0)"><?php echo($rows['brand_name']) ?></a>,
                                    <a href="javascript:void(0)"><?php echo($rows['model_name']) ?></a>,
                                    <a href="javascript:void(0)"><?php echo($rows['category_name']) ?></a>,
                                    <a href="javascript:void(0)"><?php echo($rows['sub_cate_name']) ?></a>
                                </div>
                                <div class="uren-social_link">
                                    <ul>
                                        <li class="facebook">
                                            <a href="https://www.facebook.com/" data-toggle="tooltip" target="_blank" title="Facebook">
                                                <i class="fab fa-facebook"></i>
                                            </a>
                                        </li>
                                        <li class="twitter">
                                            <a href="https://twitter.com/" data-toggle="tooltip" target="_blank" title="Twitter">
                                                <i class="fab fa-twitter-square"></i>
                                            </a>
                                        </li>
                                        <li class="youtube">
                                            <a href="https://www.youtube.com/" data-toggle="tooltip" target="_blank" title="Youtube">
                                                <i class="fab fa-youtube"></i>
                                            </a>
                                        </li>
                                        <li class="google-plus">
                                            <a href="https://www.plus.google.com/discover" data-toggle="tooltip" target="_blank" title="Google Plus">
                                                <i class="fab fa-google-plus"></i>
                                            </a>
                                        </li>
                                        <li class="instagram">
                                            <a href="https://rss.com/" data-toggle="tooltip" target="_blank" title="Instagram">
                                                <i class="fab fa-instagram"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Uren's Single Product Sale Area End Here -->

        <!-- Begin Uren's Single Product Tab Area -->
        <div class="sp-product-tab_area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="sp-product-tab_nav">
                            <div class="product-tab">
                                <ul class="nav product-menu">
                                    <li><a class="active" data-toggle="tab" href="#description"><span>Description</span></a>
                                    </li>
                                    <li><a data-toggle="tab" href="#specification"><span>Specification</span></a></li>
                                    <li><a data-toggle="tab" href="#reviews"><span>Reviews</span></a></li>
                                </ul>
                            </div>
                            <div class="tab-content uren-tab_content">
                                <div id="description" class="tab-pane active show" role="tabpanel">
                                    <div class="product-description">
                                        <ul>
                                            <li>
                                                <strong><?php echo($rows['name']) ?></strong>
                                                <span><?php echo($rows['detials']) ?></span>
                                            </li>


                                        </ul>
                                    </div>
                                </div>
                                <div id="specification" class="tab-pane" role="tabpanel">

                                    <table class="table table-bordered specification-inner_stuff">
                                        <?php
                                            include_once "products.php";
                                            $pro = new products;
                                            $pro->setProId($_GET['pro']);
                                            $pro->setSuppId($_GET['supp']);
                                            $result=$pro->getspecifications();
                                            while($row=mysqli_fetch_assoc($result))
                                            {
                                            ?>
                                        <tbody>
                                            <tr>
                                                <td colspan="2"><strong><?php echo($row['specification'])?></strong></td>
                                            </tr>
                                        </tbody>
                                        <tbody>
                                            <tr>
                                                <td><?php echo($row['specification_value'])?></td>
                                            </tr>
                                        </tbody>
                                        <?php
                                    }
                                    ?>
                                    </table>

                                </div>
                                <div id="reviews" class="tab-pane" role="tabpanel">
                                    <div class="tab-pane active" id="tab-review">
                                        <form class="form-horizontal" id="form-review">
                                            <div id="review">
                                                <?php
                                                include_once "products.php";
                                                $pro = new products;
                                                $pro->setProId($_GET['pro']);
                                                $pro->setSuppId($_GET['supp']);
                                                $result=$pro->getreview();
                                                while($row=mysqli_fetch_assoc($result))
                                                {
                                                ?>
                                                <table class="table table-striped table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td style="width: 50%;"><strong><?php echo($row['first_name']);echo("&nbsp;"); echo($row['last_name']);?></strong></td>
                                                            <td class="text-right"><?php echo($row['date'])?></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                <p><?php echo($row['comment'])?></p>
                                                                <div class="rating-box">
                                                                    <ul>
                                                                    <?php
                                                                        // $rate = $pro->getrating();
                                                                        // $r=0;
                                                                        // if($ratevalue=mysqli_fetch_assoc($rate))
                                                                            // $r=$ratevalue['average'];
                                                                            for($x=0;$x<$row['value'];$x++)
                                                                                {
                                                                        ?>
                                                                        <li><i class="ion-android-star"></i></li>
                                                                        <?php
                                                                        }
                                                                            for($x=0;$x<5-$row['value'];$x++)
                                                                                {
                                                                        ?>
                                                                        <li class="silver-color"><i class="ion-android-star"></i></li>
                                                                        <?php
                                                                        }
                                                                    ?>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <?php
                                                }
                                                ?>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Uren's Single Product Tab Area End Here -->
       <?php
                                        }
       ?>
         <!-- Begin Uren's Product Area -->
         <div class="uren-product_area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title_area">
                            <span></span>
                            <h3>Related Products</h3>
                        </div>
                        <?php
                        include_once "products.php";
                        $pro = new products;
                        $pro->setSubId($rows['sub_cate_id']);
                        $arrall=[];
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

                    $result=$pro->relatedProducts();

                    while($row=mysqli_fetch_assoc($result))
                    {
                        $arrall[]=$row;
                        $pro->setProId($row['product_id']);
                        $pro->setSuppId($row['supplier_id']);
                        ?>
                            <div class="product-slide_item">
                                <div class="inner-slide">
                                    <div class="single-product">
                                        <div class="product-img">
                                        <?php
                                            $ro = $pro->getSingleProductImages();
                                            while($rowss = mysqli_fetch_assoc($ro))
                                            {

                                            ?>
                                            <a href="single-product-sale.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id']) ?>">
                                            <?php
                                                if($rowss['status'] == 'primary')
                                                    {
                                                    ?>
                                            <img class="primary-img" src="../public/assets/images/products/<?php echo($rowss['image_name']) ?>" alt="Uren's Product Image">
                                            <?php
                                                }
                                                if($rowss['status'] == 'secondary')
                                                {
                                                ?>
                                            <img class="secondary-img" src="../public/assets/images/products/<?php echo($rowss['image_name']) ?>" alt="Uren's Product Image">
                                            <?php
                                                    }
                                            }
                                                    ?>
                                            </a>
                                            <div class="sticker">
                                                <span class="sticker">New</span>
                                            </div>
                                            <div class="add-actions">
                                                <ul>
                                                    <li><a class="uren-add_cart" href="cart.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id'])?>" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="ion-bag"></i></a>
                                                    </li>
                                                    <li><a class="uren-wishlist" href="wishlist.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id'])?>" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i class="ion-android-favorite-outline"></i></a>
                                                    </li>

                                                    <li class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter<?php echo($row['product_id']);echo($row['supplier_id']) ?>"><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Quick View"><i
                                                            class="ion-android-open"></i></a></li>
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
                                                <h6><a class="product-name" href="single-product.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id'])?>"><?php echo($row['name']) ?></a></h6>
                                                <div class="price-box">
                                                    <span class="new-price"><?php echo('<b> '.$row['price'].' EGP</b>') ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                    <?php } ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- Uren's Product Area End Here -->



        <!-- Begin Uren's Product Area -->
        <div class="uren-product_area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title_area">
                            <span></span>
                            <h3>Similar Products</h3>
                        </div>
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
                    include_once "products.php";
                    $pro = new products;
                    $pro->setproname($rows['name']);
                    $pro->setSubId($rows['sub_cate_id']);
                    $result=$pro->similarProducts();

                    while($row=mysqli_fetch_assoc($result))
                    {
                        $arrall[]=$row;
                        $pro->setProId($row['product_id']);
                        $pro->setSuppId($row['supplier_id']);
                        ?>
                            <div class="product-slide_item">
                                <div class="inner-slide">
                                    <div class="single-product">
                                        <div class="product-img">
                                        <?php
                                            $ss = $pro->getSingleProductImages();
                                            while($rowsss = mysqli_fetch_assoc($ss))
                                            {
                                            ?>
                                            <a href="single-product-sale.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id']) ?>">
                                            <?php
                                                if($rowsss['status'] == 'primary')
                                                    {
                                                    ?>
                                            <img class="primary-img" src="../public/assets/images/products/<?php echo($rowsss['image_name']) ?>" alt="Uren's Product Image">
                                            <?php
                                                }
                                                if($rowsss['status'] == 'secondary')
                                                {
                                                ?>
                                            <img class="secondary-img" src="../public/assets/images/products/<?php echo($rowsss['image_name']) ?>" alt="Uren's Product Image">
                                            <?php
                                                    }
                                            }
                                            ?>
                                            </a>
                                            <div class="sticker">
                                                <span class="sticker">New</span>
                                            </div>
                                            <div class="add-actions">
                                                <ul>
                                                    <li><a class="uren-add_cart" href="cart.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id'])?>" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="ion-bag"></i></a>
                                                    </li>
                                                    <li><a class="uren-wishlist" href="wishlist.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id'])?>" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i class="ion-android-favorite-outline"></i></a>
                                                    </li>

                                                    <li class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter<?php echo($row['product_id']);echo($row['supplier_id']) ?>"><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Quick View"><i
                                                            class="ion-android-open"></i></a></li>
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
                                                <h6><a class="product-name" href="single-product.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id'])?>"><?php echo($row['name']) ?></a></h6>
                                                <div class="price-box">
                                                    <span class="new-price"><?php echo('<b> '.$row['price'].' EGP</b>') ?></span>
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
        <!-- Uren's Product Area End Here -->
        <?php
            foreach($arrall as $value)
            {
                $pro->setProId($value['product_id']);
                $pro->setSuppId($value['supplier_id']);
                include "modal.php";
            }
        ?>

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
                                            while($rowbr = mysqli_fetch_assoc($br)){
                                            ?>
                            <div class="slide-item">
                                <div class="inner-slide">
                                    <div class="single-product">
                                        <a href="allproducts.php?brand_id=<?php echo($rowbr['brand_id']) ?>">
                                            <img width="170px" height="150px" src="../public/assets/images/brands/<?php echo($rowbr['brand_image'])?>" alt="<?php echo($rowbr['brand_name'])?>"
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
        <?php include "footer.php"; ?>
