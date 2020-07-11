
<!-- <div class="modal fade" id="exampleModalCenter<?php //echo($value['product_id']);echo($value['supplier_id']); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" id="quick" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <div class="sp-area">
                    <div class="container-fluid">
                        <div class="sp-nav">
                            <div class="row">
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
                                        $resultt2 = $pro->getSingleProductImages();
                                        while ($rows = mysqli_fetch_assoc($resultt2))
                                        {
                                        ?>
                                            <div class="single-slide red" >
                                                <?php
                                                if($rows['status'] == 'primary')
                                                {
                                                ?>
                                                <img src="assets/images/product/large-size/<?php echo($rows['image_name']) ?>" style="width: 100%; display: inline-block;" alt="Uren's Product Image">
                                                <?php
                                                }
                                                ?>
                                            </div>
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
                                        $result = $pro->getSingleProductImages();
                                        while ($rowss = mysqli_fetch_assoc($result))
                                        {
                                        ?>
                                            <div class="single-slide red">
                                            <?php
                                                if($rowss['status'] == 'primary')
                                                {
                                                ?>
                                                <img src="assets/images/product/small-size/<?php echo($rowss['image_name']) ?>" alt="Uren's Product Thumnail">
                                            <?php
                                                }
                                                if($rowss['status'] == 'secondary')
                                                {
                                            ?>
                                                <img src="assets/images/product/small-size/<?php echo($rowss['image_name']) ?>" alt="Uren's Product Thumnail">
                                                <?php
                                                }
                                                if($rowss['status'] == 'others')
                                                {
                                                ?>
                                                <img src="assets/images/product/small-size/<?php echo($rowss['image_name']) ?>" alt="Uren's Product Thumnail">
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
                                            <h5><a href="#"><?php echo($value['name']) ?></a></h5>
                                        </div>
                                        <span class="reference">Reference: demo_1</span>
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
                                        <div class="sp-essential_stuff">
                                            <ul>
                                                <li>Brands <a href="javascript:void(0)"><?php echo($value['brand_name']) ?></a></li>
                                                <li>Product Code: <a href="javascript:void(0)"><?php echo($value['product_id'].$value['supplier_id']) ?></a></li>
                                                <?php
                                                if($row['stock_quantity']>0){
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

                                        <div class="quantity">
                                            <label>Quantity</label>
                                            <div class="cart-plus-minus">
                                                <input class="cart-plus-minus-box" value="1" type="text">
                                                <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                                <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                            </div>
                                        </div>
                                        <div class="qty-btn_area">
                                            <ul>
                                                <li><a href="cart.php?pro=<?php echo($value['product_id']) ?>&supp=<?php echo($value['supplier_id']) ?>" class="addToCart">Add To Cart</a></li>
                                                <li><a class="qty-wishlist_btn" href="wishlist.html" data-toggle="tooltip" title="Add To Wishlist"><i class="ion-android-favorite-outline"></i></a>
                                                </li>
                                                <li><a class="qty-compare_btn" href="compare.html" data-toggle="tooltip" title="Compare This Product"><i class="ion-ios-shuffle-strong"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="uren-tag-line">
                                            <h6>Tags:</h6>
                                            <a href="javascript:void(0)"><?php echo($value['brand_name']) ?></a>,
                                            <a href="javascript:void(0)"><?php echo($value['model_name']) ?></a>,
                                            <a href="javascript:void(0)"><?php echo($value['category_name']) ?></a>,
                                            <a href="javascript:void(0)"><?php echo($value['sub_cate_name']) ?></a>
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
            </div>
        </div>
    </div>
</div> -->

<!-- ........................... -->

    <div class="modal fade modal-wrapper" id="exampleModalCenter<?php echo($value['product_id']);echo($value['supplier_id']); ?>">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="modal-inner-area sp-area row">
                            <div class="col-lg-5">
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
                                        $pic = $pro->getSingleProductImages();
                                        while ($rowpic = mysqli_fetch_assoc($pic))
                                        {
                                        ?>
                                            <div class="single-slide red">
                                            <?php
                                                if($rowpic['status'] == 'primary')
                                                {
                                            ?>
                                                <img src="../public/assets/images/products/<?php echo($rowpic['image_name']) ?>" alt="Uren's Product Image">
                                            <?php
                                                }
                                                if($rowpic['status'] == 'secondary')
                                                {
                                            ?>
                                                <img src="../public/assets/images/products/<?php echo($rowpic['image_name']) ?>" alt="Uren's Product Image">
                                            <?php
                                                }
                                                if($rowpic['status'] == 'others')
                                                {
                                            ?>
                                                <img src="../public/assets/images/products/<?php echo($rowpic['image_name']) ?>" alt="Uren's Product Image">
                                            <?php
                                                }
                                            ?>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="sp-img_slider-nav slick-slider-nav uren-slick-slider slider-navigation_style-3" data-slick-options='{
                                   "slidesToShow": 4,
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
                                    $pic1 = $pro->getSingleProductImages();
                                    while ($rowpic1 = mysqli_fetch_assoc($pic1))
                                    {
                                    ?>
                                        <div class="single-slide red">
                                        <?php
                                            if($rowpic1['status'] == 'primary')
                                            {
                                        ?>
                                            <img src="../public/assets/images/products/<?php echo($rowpic1['image_name']) ?>" alt="Uren's Product Thumnail">
                                            <?php
                                                }
                                                if($rowpic1['status'] == 'secondary')
                                                {
                                            ?>
                                            <img src="../public/assets/images/products/<?php echo($rowpic1['image_name']) ?>" alt="Uren's Product Thumnail">
                                            <?php
                                                }
                                                if($rowpic1['status'] == 'others')
                                                {
                                                ?>
                                            <img src="../public/assets/images/products/<?php echo($rowpic1['image_name']) ?>" alt="Uren's Product Thumnail">
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
                            <div class="col-xl-7 col-lg-6">
                                <div class="sp-content">
                                    <div class="sp-heading">
                                        <h5><a href="#"><?php echo($value['name']) ?></a></h5>
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
                                    <?php
                                    if(isset($value['percentage']) )
                                    {
                                        // echo('two');
                                    ?>
                                    <div class="price-box">
                                        <span class="new-price new-price-2"><?php $old=$value['price'];$totalDisc = $value['percentage'] +$value['discount'];$discount= $value['price']*$totalDisc;$new = round($new = $old-$discount,2); echo($new.' EGP'); ?></span>
                                        <span class="old-price"><?php echo($value['price'].' EGP') ?></span>
                                    </div>
                                    <?php
                                    }else{
                                        // echo('one');
                                    ?>
                                    <div class="price-box">

                                        <span class="new-price new-price-2"><?php $old=$value['price'];$discount= $value['discount']*$value['price'];$new = round($new = $old-$discount,2); echo($new.' EGP'); ?></span>

                                    </div>
                                    <?php
                                    }
                                    ?>


                                    <div class="sp-essential_stuff">
                                        <ul>
                                            <li>Brands <a href="javascript:void(0)"><?php echo($value['brand_name']) ?></a></li>
                                            <li>Product Code: <a href="javascript:void(0)"><?php echo($value['product_id'].$value['supplier_id']) ?></a></li>
                                            <?php
                                                if($value['stock_quantity']>0){
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
                                    <div class="uren-group_btn">
                                        <ul>
                                            <li><a href="cart.php?pro=<?php echo($value['product_id']) ?>&supp=<?php echo($value['supplier_id']) ?>" class="add-to_cart">Cart To Cart</a></li>
                                            <li><a href="wishlist.php?pro=<?php echo($value['product_id']) ?>&supp=<?php echo($value['supplier_id'])?>"><i class="ion-android-favorite-outline"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="uren-tag-line">
                                        <h6>Tags:</h6>
                                        <a href="javascript:void(0)"><?php echo($value['brand_name']) ?></a>,
                                        <a href="javascript:void(0)"><?php echo($value['model_name']) ?></a>,
                                        <a href="javascript:void(0)"><?php echo($value['category_name']) ?></a>,
                                        <a href="javascript:void(0)"><?php echo($value['sub_cate_name']) ?></a>

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
        </div>
