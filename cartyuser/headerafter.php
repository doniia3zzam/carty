 <?php

if(isset($_SESSION['username'])){
    ;
}
else{
    header('location:login.php');
}
?>
<!doctype html>
<html class="no-js" lang="zxx">


<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Carty</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico">

    <!-- CSS
	============================================ -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="assets/css/vendor/font-awesome.css">
    <!-- Fontawesome Star -->
    <link rel="stylesheet" href="assets/css/vendor/fontawesome-stars.css">
    <!-- Ion Icon -->
    <link rel="stylesheet" href="assets/css/vendor/ion-fonts.css">
    <!-- Slick CSS -->
    <link rel="stylesheet" href="assets/css/plugins/slick.css">
    <!-- Animation -->
    <link rel="stylesheet" href="assets/css/plugins/animate.css">
    <!-- jQuery Ui -->
    <link rel="stylesheet" href="assets/css/plugins/jquery-ui.min.css">
    <!-- Lightgallery -->
    <link rel="stylesheet" href="assets/css/plugins/lightgallery.min.css">
    <!-- Nice Select -->
    <link rel="stylesheet" href="assets/css/plugins/nice-select.css">



    <!-- Vendor & Plugins CSS (Please remove the comment from below vendor.min.css & plugins.min.css for better website load performance and remove css files from the above) -->
    <!--
    <script src="assets/js/vendor/vendor.min.js"></script>
    <script src="assets/js/plugins/plugins.min.js"></script>
    -->

    <!-- Main Style CSS (Please use minify version for better website load performance) -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!--<link rel="stylesheet" href="assets/css/style.min.css">-->
    <!-- galal css  -->
    <link rel="stylesheet" href="assets/css/galal.css">

    <!-- jquery  -->
    <script src="assets/js/jquery-3.3.0.min.js"></script>

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- ajax request for search  -->
    <script src="assets/js/search.js"></script>



</head>
<!-- /* loader */  -->
<div class="spinnerback">
    <div class="spinner-border text-primary" role="status">
        <div class="loader"></div>
    </div>
</div>
 <!-- end loader  -->
<body class="template-color-1">

    <div class="main-wrapper">

        <!-- Begin Uren's Header Main Area -->
        <header class="header-main_area header-main_area-2 header-main_area-3">
            <div class="header-middle_area">

            <div class="bg-warning container-fluid d-flex  justify-content-end">
                <div class="text-left">
                    <a href="before_signup.php" class="text-dark col-4"> <b>Sell With Us</b> </a>
                </div>

            </div>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-3 col-lg-2 col-md-3 col-sm-5">
                            <div class="header-logo_area">
                                <a href="index.php">
                                    <img src="../public/assets/images/menu/logo/2.png" alt="Uren's Logo" style="height:60px">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-6 d-none d-lg-block">
                            <div class="hm-form_area">
                            <form method="post" class="hm-searchbox" >


                                   <input type="text" name="search" id="searchBox" placeholder="Enter your search key ..." autocomplete="off">

                                       <?php
                                           if(isset($_POST['submit']))
                                           {
                                               //VALIDATION
                                               header('location:allproducts.php?key='.$_POST['search']);
                                           }
                                       ?>


                                   <button class="header-search_btn" type="submit" name="submit" id="submitSearch"><i class="ion-ios-search-strong"><span>Search</span></i></button>
                                   <div id="response" ></div>
                               </form>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-9 col-sm-7">
                            <div class="header-right_area">
                                <ul>
                                    <li class="mobile-menu_wrap d-flex d-lg-none">
                                        <a href="#mobileMenu" class="mobile-menu_btn toolbar-btn color--white">
                                            <i class="ion-navicon"></i>
                                        </a>
                                    </li>
                                    <li class="minicart-wrap" id="cartss">
                                        <a href="#miniCart" class="minicart-btn toolbar-btn">
                                            <div class="minicart-count_area">
                                            <?php
                                                    include_once "temp_cart.php";
                                                    $cart = new temp_cart();
                                                    // ob_start();
                                                    // session_start();
                                                    $cart->setUserId($_SESSION['userid']);
                                                    // echo($_SESSION['userid']);
                                                    $res = $cart->getCount();
                                                    if ($row = mysqli_fetch_assoc($res)) {
                                                       ?>
                                                            <span class="item-count"><?php echo($row['cartCount']) ?></span>

                                                       <?php
                                                    }
                                                ?>


                                                <i class="ion-bag"></i>
                                            </div>
                                            <!-- <div class="minicart-front_text">
                                                <span>Cart:</span>
                                                <span class="total-price">462.4</span>
                                            </div> -->
                                        </a>
                                    </li>
                                    <li class="contact-us_wrap">
                                    <a href="tel://+01144895434"><i class="ion-android-call"></i>+2011 4489 5434</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-top_area bg--primary">
                <div class="container-fluid">
                    <div class="row">
                        <div class="custom-category_col col-12">
                            <div class="category-menu category-menu-hidden">
                                <div class="category-heading">
                                    <h2 class="categories-toggle">
                                        <span>Shop By</span>
                                        <span>Department</span>
                                    </h2>
                                </div>
                                <div id="cate-toggle" class="category-menu-list">
                                    <ul>
                                        <?php

                                        include_once "categories.php";
                                        $cat = new categories();
                                        $result = $cat->getAll();
                                        while($row=mysqli_fetch_assoc($result)){

                                        ?>
                                        <li class="right-menu"><a href="allproducts.php?cate=<?php echo($row['category_id']) ?>"><?php echo($row['category_name']) ?></a>

                                        <!-- <li class="right-menu"><a href="shop-left-sidebar.php"><?php echo($row['category_name']) ?></a> -->
                                            <ul class="cat-mega-menu">
                                                <li class="right-menu cat-mega-title">
                                                    <!-- <a href="shop-left-sidebar.php">Active body control</a> -->
                                                    <ul>
                                                        <?php
                                                        include_once "subcategories.php";
                                                        $sub = new subcategories();
                                                        $result1 = $sub->getEachSub($row['category_id']);
                                                        $count = 0;
                                                        while($row1=mysqli_fetch_assoc($result1)){
                                                            if($count < 4){


                                                        ?>
                                                        <li><a href="allproducts.php?cate=<?php echo($row['category_id']) ?>&sub=<?php echo($row1['sub_cate_id']) ?>"><?php echo($row1['sub_cate_name']) ?></a></li>

                                                        <!-- <li><a href="shop-left-sidebar.php"><?php echo($row1['sub_cate_name']) ?></a></li> -->
                                                        <?php
                                                            }
                                                        }
                                                        ?>

                                                    </ul>
                                                </li>
                                                <!-- <li class="right-menu cat-mega-title">
                                                    <a href="shop-left-sidebar.php">Battery Indicator</a>
                                                    <ul>
                                                        <li><a href="shop-left-sidebar.php">Sanai laptops</a></li>
                                                        <li><a href="shop-left-sidebar.php">Byteflight</a></li>
                                                        <li><a href="shop-left-sidebar.php">EXcaliberPC</a></li>
                                                        <li><a href="shop-left-sidebar.php">Gaming Laptops</a></li>
                                                    </ul>
                                                </li>
                                                <li class="right-menu cat-mega-title">
                                                    <a href="shop-left-sidebar.php">Remote Starter</a>
                                                    <ul>
                                                        <li><a href="shop-left-sidebar.php">Dual Core</a></li>
                                                        <li><a href="shop-left-sidebar.php">Gaming Monitors</a></li>
                                                        <li><a href="shop-left-sidebar.php">GPS Monitors</a></li>
                                                        <li><a href="shop-left-sidebar.php">Heat Shield</a></li>
                                                    </ul>
                                                </li> -->

                                        </li>
                                    </ul>
                                        <?php
                                        }
                                        ?>
                                </div>
                            </div>
                        </div>
                        <div class="custom-menu_col col-12 d-none d-lg-block">
                            <div class="main-menu_area position-relative">
                                <nav class="main-nav">
                                    <ul>
                                        <!-- <li class="dropdown-holder active"><a href="index.php">Home</a>
                                            <ul class="hm-dropdown">
                                                <li><a href="index.php">Home One</a></li>
                                                <li><a href="index-2.php">Home Two</a></li>
                                                <li><a href="index-3.php">Home Three</a></li>
                                            </ul>
                                        </li> -->

                                        <li><a href="allproducts.php">Products</a></li>
                                        <li class=""><a href="allproducts.php">Categories <i
                                                class="ion-ios-arrow-down"></i></a>
                                            <ul class="hm-dropdown">
                                                <?php
                                                include_once "categories.php";
                                                $cat = new categories();
                                                $result = $cat->getAll();
                                                while($row=mysqli_fetch_assoc($result)){
                                                ?>
                                                <li><a href="allproducts.php?cate=<?php echo($row['category_id']) ?>"><?php echo($row['category_name']) ?></a>
                                                    <ul class="hm-dropdown hm-sub_dropdown">
                                                        <?php
                                                        include_once "subcategories.php";
                                                        $sub = new subcategories();
                                                        // echo($row['category_id']);
                                                        $result1 = $sub->getEachSub($row['category_id']);
                                                        while($row1=mysqli_fetch_assoc($result1)){
                                                            ?>
                                                            <li><a href="allproducts.php?cate=<?php echo($row['category_id']) ?>&sub=<?php echo($row1['sub_cate_id']) ?>"><?php echo($row1['sub_cate_name']) ?></a></li>
                                                        <?php
                                                        }
                                                        ?>
                                                    </ul>
                                                </li>
                                                <?php
                                                }
                                                ?>
                                            </ul>
                                        </li>

                                        <li class=""><a href="about-us.php">About Us</a></li>
                                        <li class=""><a href="contact.php">Contact</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="custom-setting_col col-12 d-none d-lg-block">
                            <div class="ht-right_area">
                                <div class="ht-menu">
                                    <ul>
                                        <li><a href="custprofile.php"><img style="width:24px;height:24px;border-radius:50%;" src="../public/assets/images/customer/<?php echo($_SESSION['photo']);  ?>" alt=""> <label> <?php echo($_SESSION['username']);  ?>
                                            </label><i class="fa fa-chevron-down"></i></a>
                                            <ul class="ht-dropdown ht-my_account">
                                                <!-- <li><a href="myaccount.php">My Addresses <span class="fa fa-user"></span></a></li> -->
                                                <li><a href="myaccount.php">My Addresses <span class="fa fa-user"></span></a></li>
                                                <li><a href="myorders.php">My orders <span class="fas fa-paper-plane"></span></a></li>
                                                <li><a href="wishlist.php">My wishlist <span class="fas fa-paper-plane"></span></a></li>
                                                <li class=""><a href="logout.php">Logout <i class="fas fa-sign-out-alt"></i></a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="custom-search_col col-12 d-none d-md-block d-lg-none">
                            <div class="hm-form_area">
                                <form action="#" class="hm-searchbox">
                                    <select class="nice-select select-search-category">
                                        <option value="0">All Categories</option>
                                        <option value="10">Laptops</option>
                                        <option value="17">Prime Video</option>
                                        <option value="20">All Videos</option>
                                        <option value="21">Blouses</option>
                                        <option value="22">Evening Dresses</option>
                                        <option value="23">Summer Dresses</option>
                                        <option value="24">T-shirts</option>
                                        <option value="25">Rent or Buy</option>
                                        <option value="26">Your Watchlist</option>
                                        <option value="27">Watch Anywhere</option>
                                        <option value="28">Getting Started</option>
                                        <option value="18">Computers</option>
                                        <option value="29">More to Explore</option>
                                        <option value="30">TV &amp; Video</option>
                                        <option value="31">Audio &amp; Theater</option>
                                        <option value="32">Camera, Photo </option>
                                        <option value="33">Cell Phones</option>
                                        <option value="34">Headphones</option>
                                        <option value="35">Video Games</option>
                                        <option value="36">Wireless Speakers</option>
                                        <option value="19">Electronics</option>
                                        <option value="37">Amazon Home</option>
                                        <option value="38">Kitchen &amp; Dining</option>
                                        <option value="39">Furniture</option>
                                        <option value="40">Bed &amp; Bath</option>
                                        <option value="41">Appliances</option>
                                        <option value="11">TV &amp; Audio</option>
                                        <option value="42">Chamcham</option>
                                        <option value="45">Office</option>
                                        <option value="47">Gaming</option>
                                        <option value="48">Chromebook</option>
                                        <option value="49">Refurbished</option>
                                        <option value="50">Touchscreen</option>
                                        <option value="51">Ultrabooks</option>
                                        <option value="52">Blouses</option>
                                        <option value="43">Sanai</option>
                                        <option value="53">Hard Drives</option>
                                        <option value="54">Graphic Cards</option>
                                        <option value="55">Processors (CPU)</option>
                                        <option value="56">Memory</option>
                                        <option value="57">Motherboards</option>
                                        <option value="58">Fans &amp; Cooling</option>
                                        <option value="59">CD/DVD Drives</option>
                                        <option value="44">Meito</option>
                                        <option value="60">Sound Cards</option>
                                        <option value="61">Cases &amp; Towers</option>
                                        <option value="62">Casual Dresses</option>
                                        <option value="63">Evening Dresses</option>
                                        <option value="64">T-shirts</option>
                                        <option value="65">Tops</option>
                                        <option value="12">Smartphone</option>
                                        <option value="66">Camera Accessories</option>
                                        <option value="68">Octa Core</option>
                                        <option value="69">Quad Core</option>
                                        <option value="70">Dual Core</option>
                                        <option value="71">7.0 Screen</option>
                                        <option value="72">9.0 Screen</option>
                                        <option value="73">Bags &amp; Cases</option>
                                        <option value="67">XailStation</option>
                                        <option value="74">Batteries</option>
                                        <option value="75">Microphones</option>
                                        <option value="76">Stabilizers</option>
                                        <option value="77">Video Tapes</option>
                                        <option value="78">Memory Card Readers</option>
                                        <option value="79">Tripods</option>
                                        <option value="13">Cameras</option>
                                        <option value="14">headphone</option>
                                        <option value="15">Smartwatch</option>
                                        <option value="16">Accessories</option>
                                    </select>
                                    <input type="text" placeholder="Enter your search key ...">
                                    <button class="header-search_btn" type="submit"><i
                                        class="ion-ios-search-strong"><span>Search</span></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-top_area header-sticky bg--primary">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-7 col-lg-6 d-lg-block d-none">
                            <div class="main-menu_area position-relative">
                                <nav class="main-nav">
                                    <ul>
                                        <li class="dropdown-holder active"><a href="index.php">Home</a>
                                        </li>

                                        <li><a href="allproducts.php">Products</a></li>
                                        <li class=""><a href="allproducts.php">Categories <i
                                                class="ion-ios-arrow-down"></i></a>
                                            <ul class="hm-dropdown">
                                                <?php
                                                include_once "categories.php";
                                                $cat = new categories();
                                                $result = $cat->getAll();
                                                while($row=mysqli_fetch_assoc($result)){
                                                ?>
                                                <li><a href="allproducts.php?cate=<?php echo($row['category_id']) ?>"><?php echo($row['category_name']) ?></a>
                                                    <ul class="hm-dropdown hm-sub_dropdown">
                                                        <?php
                                                        include_once "subcategories.php";
                                                        $sub = new subcategories();
                                                        // echo($row['category_id']);
                                                        $result1 = $sub->getEachSub($row['category_id']);
                                                        while($row1=mysqli_fetch_assoc($result1)){
                                                            ?>
                                                            <li><a href="allproducts.php?cate=<?php echo($row['category_id']) ?>&sub=<?php echo($row1['sub_cate_id']) ?>"><?php echo($row1['sub_cate_name']) ?></a></li>
                                                        <?php
                                                        }
                                                        ?>
                                                    </ul>
                                                </li>
                                                <?php
                                                }
                                                ?>
                                            </ul>
                                        </li>

                                        <li class=""><a href="about-us.php">About Us</a></li>
                                        <li class=""><a href="contact.php">Contact</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="col-sm-3 d-block d-lg-none">
                            <div class="header-logo_area header-sticky_logo">
                                <a href="indexuser.php">
                                    <img src="../public/assets/images/menu/logo/3.png" alt="Uren's Logo">
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-6 col-sm-9">
                            <div class="header-right_area">
                                <ul>
                                    <li class="mobile-menu_wrap d-flex d-lg-none">
                                        <a href="#mobileMenu" class="mobile-menu_btn toolbar-btn color--white">
                                            <i class="ion-navicon"></i>
                                        </a>
                                    </li>
                                    <li class="contact-us_wrap">
                                    <a href="tel://+01144895434"><i class="ion-android-call"></i>+2011 4489 5434</a>
                                    </li>
                                    <li class="minicart-wrap" id="cartss" >
                                        <a href="#miniCart" class="minicart-btn toolbar-btn">
                                            <div class="minicart-count_area">
                                                <?php
                                                    include_once "temp_cart.php";
                                                    $cart = new temp_cart();
                                                    $cart->setUserId($_SESSION['userid']);
                                                    $res = $cart->getCount();
                                                    if ($row = mysqli_fetch_assoc($res)) {
                                                       ?>
                                                            <span class="item-count"><?php echo($row['cartCount']) ?></span>
                                                       <?php
                                                    }
                                                ?>
                                                <i class="ion-bag"></i>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="minicart-wrap" ><a href="custprofile.php" class="stickyNavUser"><img style="width:24px;height:24px;border-radius:50%;" src="../public/assets/images/customer/<?php echo($_SESSION['photo']);  ?>" alt=""> <span> <?php echo($_SESSION['username']);  ?></span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="offcanvas-minicart_wrapper" id="miniCart">
                <div class="offcanvas-menu-inner">
                    <a href="#" class="btn-close"><i class="ion-android-close"></i></a>
                    <div class="minicart-content">
                        <div class="minicart-heading">
                            <h4>Shopping Cart</h4>
                        </div>
                        <form method="post">
                        <ul class="minicart-list">
                            <?php

                            include_once "temp_cart.php";
                            $cart = new temp_cart();
                            $cart->setUserId($_SESSION['userid']);
                            $result = $cart->getAll();
                            $total = 0;$x = 1;
                            while($row = mysqli_fetch_assoc($result))
                            {
                            ?>
                            <li class="minicart-product rem1<?php echo($x)?>">

                                <a class="product-item_remove " href="javascript:void(0)">
                                <input type="hidden"name="pro"value="<?php echo($values['product_id']);?>">
                                <input type="hidden"name="supp"value="<?php echo($values['supplier_id']);?>">
                                <button type="submit" name="txtclose1<?php echo($x)?>"  class="product-item_remove"><i class="ion-android-close"></i></button>
                                </a>
                                <?php
                                if(isset($_POST['txtclose1'.$x])){
                                    $cart->setProId($row['product_id']);
                                    $cart->setSuppId($row['supplier_id']);
                                    $cart->delete();
                                    header("Refresh:0");
                                }
                                ?>
                                <div class="product-item_img">
                                    <?php
                                    include_once "products.php";
                                    $pro = new products();
                                    $pro->setProId($row['product_id']);
                                    $pro->setSuppId($row['supplier_id']);
                                        $pic1 = $pro->getSingleProductImages();
                                        while ($rowimg1 = mysqli_fetch_assoc($pic1))
                                        {
                                            if($rowimg1['status'] == 'primary')
                                            {
                                    ?>
                                    <img src="../public/assets/images/products/<?php echo($rowimg1['image_name']) ?>" alt="Uren's Product Image">
                                    <?php
                                        }
                                    }
                                        ?>
                                </div>
                                <?php
                                ?>
                                <div class="product-item_content">
                                    <a class="product-item_title" href="shop-left-sidebar.php"><?php echo($row['product_name']) ?></a>
                                    <span class="product-item_quantity"><?php $q =$row['quantity']; echo($q .' X'); $p =$row['price']; echo($p.' EGP'); $s = $p * $q; $total+=$s?></span>
                                </div>
                            </li>
                            <script>
                                $(document).ready(function(c) {
                                $('.close1<?php echo($x)?>').on('click', function(c){
                                    $('.rem1<?php echo($x)?>').fadeOut('slow', function(c){
                                        $('.rem1<?php echo($x)?>').remove();
                                    });
                                    });
                                });
                            </script>
                            <?php
                            $x++;
                            }
                            ?>

                        </ul>
                        </form>
                    </div>
                    <div class="minicart-item_total">
                        <span>Total</span>
                        <span class="ammount"><?php  echo($total); ?></span>
                    </div>
                    <div class="minicart-btn_area">
                        <a href="cart.php" class="uren-btn uren-btn_dark uren-btn_fullwidth">Minicart</a>
                    </div>
                    <div class="minicart-btn_area">
                        <a href="checkout.php" class="uren-btn uren-btn_dark uren-btn_fullwidth">Checkout</a>
                    </div>
                </div>
            </div>

            <!-- ---------------------------------------------mobile--------------------------------------------------------------- -->
            <div class="mobile-menu_wrapper" id="mobileMenu">
                <div class="offcanvas-menu-inner">
                    <div class="container">
                        <a href="#" class="btn-close"><i class="ion-android-close"></i></a>
                        <div class="offcanvas-inner_search">
                            <form action="#" class="inner-searchbox">
                                <input type="text" placeholder="Search for item...">
                                <button class="search_btn" type="submit"><i class="ion-ios-search-strong"></i></button>
                            </form>
                        </div>
                        <nav class="offcanvas-navigation">
                            <ul class="mobile-menu">
                                <li class="menu-item-has-children active"><a href="index.php"><span
                                        class="mm-text">Home</span></a>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="allproducts.php">
                                        <span class="mm-text">Products</span>
                                    </a>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="wishlist.php">
                                        <span class="mm-text">Wishlistt</span>
                                    </a>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="Cart.php">
                                        <span class="mm-text">Cart</span>
                                    </a>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="checkout.php">
                                        <span class="mm-text">Checkout</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <nav class="offcanvas-navigation user-setting_area">
                            <ul class="mobile-menu">
                                <li class="menu-item-has-children active">
                                    <a href="javascript:void(0)">
                                        <span class="mm-text">SETTING</span>
                                    </a>
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="myaccount.php">
                                                <span class="mm-text">My Address</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="myorders.php">
                                                <span class="mm-text">My orders</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="logout.php">
                                                <span class="mm-text">Logout</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <!-- Uren's Header Main Area End Here -->
