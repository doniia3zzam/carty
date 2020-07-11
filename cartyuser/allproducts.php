<?php
ob_start();
session_start();
if(isset($_SESSION['username'])){
    include "headerafter.php";
}else{
    include "headerbefore.php";
    } ?>

<?php
include_once "products.php";
$pro = new products();
$record_per_page = 20;
$page = '';
if(isset($_GET["page"]))
{
    $page = $_GET["page"];
}
else
{
    $page = 1;
}
$start_from = ($page-1)*$record_per_page;
$pro->setLimit($start_from);
$pro->setrecord($record_per_page);
?>
        <!-- Begin Uren's Shop Left Sidebar Area -->
        <div class="shop-content_wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-5 order-2 order-lg-1 order-md-1">
                        <div class="uren-sidebar-catagories_area">
                            <div class="category-module uren-sidebar_categories">
                                <div class="category-module_heading">
                                    <h5>Categories</h5>
                                </div>
                                <div class="module-body">
                                    <ul class="module-list_item">
                                        <?php
                                        include_once "categories.php";
                                        $categ=new categories();
                                        $res=$categ->getAll();

                                        while ($rowres = mysqli_fetch_assoc($res)) {
                                            ?>
                                            <script >
                                            $(document).ready(function(){
                                                $('#check<?php echo $rowres['category_id']; ?>').on('click',function(){
                                                    $('#lis<?php echo $rowres['category_id'];?>').attr('class','fa fa-angle-down');
                                                    console.log('hhhjhj');
                                                    var check =$('#in<?php echo $rowres['category_id']; ?>').val();
                                                    console.log(check);
                                                    $.ajax({
                                                        url:"ajax/categoryajax.php",
                                                        method:"POST",
                                                        data:{check:check},
                                                        success:function(data){
                                                            console.log(data);
                                                            $('#sub<?php echo $rowres['category_id']; ?>').html(data);
                                                            }
                                                        });
                                                    });
                                                });
                                            </script>
                                            <li> <i id="lis<?php echo $rowres['category_id'];?>" class="fa fa-angle-right"> &nbsp; </i>
                                                <a id="check<?php echo $rowres['category_id'];?>" class="d-inline"  name="check"   data-toggle="collapse" href="#collapseExample<?php echo $rowres['category_id'];?>" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                        <input type="hidden" id="in<?php echo $rowres['category_id'];?>" value="<?php echo $rowres['category_id'];?>" />
                                                        <?php echo $rowres['category_name']; ?>
                                                </a>
                                            </li>
                                            <div class="collapse" id="collapseExample<?php echo $rowres['category_id'];?>">
                                                <div class="card card-body" id="sub<?php echo $rowres['category_id']; ?>" style="border:0">
                                                </div>
                                            </div>
                                            <?php
                                            }
                                            ?>
                                    </ul>
                                </div>
                            </div>
                                            <!-- </ul>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">Smartwatch <span>(9)</span></a>
                                            <a href="javascript:void(0)">Suspension Systems <span>(15)</span></a>
                                            <a href="javascript:void(0)">Tools & Accessories <span>(0)</span></a>
                                            <a href="javascript:void(0)">Turbo System <span>(18)</span></a>
                                            <a href="javascript:void(0)">TV & Audio <span>(0)</span></a>
                                            <a href="javascript:void(0)">Exterior <span>(0)</span></a>
                                            <a href="javascript:void(0)">Oils & Fluids <span>(18)</span></a>
                                            <a href="javascript:void(0)">Accessories <span>(12)</span></a>
                                            <a href="javascript:void(0)">Breakfast <span>(0)</span></a>
                                        </li> -->

                            <div class="uren-sidebar_categories">
                                <div class="uren-categories_title">
                                    <h5>Price</h5>
                                </div>
                                <div class="price-filter">
                                    <div id="slider-range"></div>
                                    <div class="price-slider-amount">
                                        <div class="label-input">
                                            <label>price : </label>
                                            <input type="text" id="amount" name="price" placeholder="Add Your Price" />
                                        </div>
                                        <!-- <button type="button">Filter</button> -->
                                    </div>
                                </div>
                            </div>
                            <div class="uren-sidebar_categories">
                                <div class="uren-categories_title">
                                    <h5>Color</h5>
                                </div>
                                <ul class="sidebar-checkbox_list">
                                    <li>
                                        <a href="javascript:void(0)">Black <span>(6)</span></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">Blue <span>(2)</span></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">Red <span>(3)</span></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">Yellow <span>(0)</span></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="uren-sidebar_categories">
                                <div class="uren-categories_title">
                                    <h5>Manufacturers</h5>
                                </div>
                                <ul class="sidebar-checkbox_list">
                                    <li>
                                        <a href="javascript:void(0)">Sanai <span>(10)</span></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">Xail <span>(2)</span></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">Chamcham <span>(1)</span></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">Meito <span>(3)</span></a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">Walton <span>(0)</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="sidebar-banner_area">
                            <div class="banner-item img-hover_effect">
                                <a href="javascript:void(0)">
                                    <img src="../public/assets/images/shop/1.jpg" alt="Uren's Shop Banner Image">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-7 order-1 order-lg-2 order-md-2">
                        <div class="shop-toolbar">
                            <div class="product-view-mode">
                                <a class="grid-1" data-target="gridview-1" data-toggle="tooltip" data-placement="top" title="1">1</a>
                                <a class="grid-2" data-target="gridview-2" data-toggle="tooltip" data-placement="top" title="2">2</a>
                                <a class="active grid-3" data-target="gridview-3" data-toggle="tooltip" data-placement="top" title="3">3</a>
                                <a class="grid-4" data-target="gridview-4" data-toggle="tooltip" data-placement="top" title="4">4</a>
                                <a class="grid-5" data-target="gridview-5" data-toggle="tooltip" data-placement="top" title="5">5</a>
                                <a class="list" data-target="listview" data-toggle="tooltip" data-placement="top" title="List"><i class="fa fa-th-list"></i></a>
                            </div>
                            <div class="product-item-selection_area">
                                <div class="product-short">
                                    <label class="select-label">Short By:</label>
                                    <select class="myniceselect nice-select">
                                        <option value="1">Default</option>
                                        <option value="2">Name, A to Z</option>
                                        <option value="3">Name, Z to A</option>
                                        <option value="4">Price, low to high</option>
                                        <option value="5">Price, high to low</option>
                                        <option value="5">Rating (Highest)</option>
                                        <option value="5">Rating (Lowest)</option>
                                        <option value="5">Model (A - Z)</option>
                                        <option value="5">Model (Z - A)</option>
                                    </select>
                                </div>
                                <div class="product-showing">
                                    <label class="select-label">Show:</label>
                                    <select class="myniceselect short-select nice-select">
                                        <option value="1">15</option>
                                        <option value="1">1</option>
                                        <option value="1">2</option>
                                        <option value="1">3</option>
                                        <option value="1">4</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="shop-product-wrap grid gridview-3 img-hover-effect_area row "  id="show">
                            <?php

                                $arrall=[];
                                if(isset($_GET['cate']) && isset($_GET['sub']))
                                {
                                    //cate && sub
                                    $pro->setSubId($_GET['sub']);
                                    $pro->setCateId($_GET['cate']);

                                    $totalRec = $pro->getAllWithCateAndSub(1);
                                    $total_cat_sub=mysqli_num_rows($totalRec);
                                    $total_pages = ceil($total_cat_sub/$record_per_page);

                                    $result = $pro->getAllWithCateAndSub(0);
                                    while ($row = mysqli_fetch_assoc($result))
                                    {
                                        $arrall[]=$row;
                                        $pro->setProId($row['product_id']);
                                        $pro->setSuppId($row['supplier_id']);
                                        ?>
                                           <div class="col-lg-4">
                                                <div class="product-slide_item">
                                                    <div class="inner-slide">
                                                        <div class="single-product">
                                                            <div class="product-img">
                                                            <?php
                                                                $pic1 = $pro->getSingleProductImages();
                                                                while ($rowimg1 = mysqli_fetch_assoc($pic1))
                                                                {
                                                                ?>
                                                                <a href="single-product-sale.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id']) ?>">
                                                                <?php
                                                                    if($rowimg1['status'] == 'primary')
                                                                    {
                                                                ?>
                                                                    <img class="primary-img" src="../public/assets/images/products/<?php echo($rowimg1['image_name']) ?>" alt="Uren's Product Thumnail">
                                                                    <?php
                                                                        }
                                                                        if($rowimg1['status'] == 'secondary')
                                                                        {
                                                                    ?>
                                                                    <img class="secondary-img" src="../public/assets/images/products/<?php echo($rowimg1['image_name']) ?>" alt="Uren's Product Thumnail">
                                                                    <?php
                                                                        }?>

                                                                </a>
                                                                    <?php
                                                                    }
                                                            ?>
                                                                <div class="sticker">
                                                                    <span class="sticker">New</span>
                                                                </div>
                                                                <div class="add-actions">
                                                                    <ul>
                                                                    <li><a class="uren-add_cart" href="cart.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id'])?>" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="ion-bag"></i></a></li>
                                                                        </li>
                                                                        <li><a class="uren-wishlist" href="wishlist.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id'])?>" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i
                                                                            class="ion-android-favorite-outline"></i></a>
                                                                        </li>

                                                                        <li class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter<?php echo($row['product_id']);echo($row['supplier_id'])?>"><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Quick View"><i
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
                                                                    <h6><a class="product-name" href="single-product-sale.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id']) ?>"><?php echo($row['name']) ?></a></h6>
                                                                    <div class="price-box">
                                                                        <span class="new-price"><?php echo('<b> '.$row['price'].' EGP</b>') ?></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="list-slide_item">
                                                    <div class="single-product">
                                                        <div class="product-img">
                                                            <?php
                                                                    $pic2 = $pro->getSingleProductImages();
                                                                    while ($rowimg2 = mysqli_fetch_assoc($pic2))
                                                                    {
                                                                    ?>
                                                                    <a href="single-product-sale.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id']) ?>">
                                                                    <?php
                                                                        if($rowimg2['status'] == 'primary')
                                                                        {
                                                                    ?>
                                                                        <img class="primary-img" src="../public/assets/images/products/<?php echo($rowimg2['image_name']) ?>" alt="Uren's Product Thumnail">
                                                                        <?php
                                                                            }
                                                                            if($rowimg2['status'] == 'secondary')
                                                                            {
                                                                        ?>
                                                                        <img class="secondary-img" src="../public/assets/images/products/<?php echo($rowimg2['image_name']) ?>" alt="Uren's Product Thumnail">
                                                                        <?php
                                                                            }?>

                                                                    </a>
                                                                        <?php
                                                                        }
                                                                ?>
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
                                                                <h6><a class="product-name" href="single-product.html"><?php echo($row['name']) ?></a></h6>
                                                                <div class="price-box">
                                                                    <span class="new-price"><?php echo('<b> '.$row['price'].' EGP</b>') ?></span>
                                                                </div>
                                                                <div class="product-short_desc">
                                                                    <p> <?php echo($row['detials'])?></p>
                                                                </div>
                                                            </div>
                                                            <div class="add-actions">
                                                                <ul>
                                                                    <li><a class="uren-add_cart" href="cart.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id'])?>" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="ion-bag"></i></a>
                                                                    </li>
                                                                    <li><a class="uren-wishlist" href="wishlist.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id'])?>" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                                    </li>

                                                                    <li class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter<?php echo($row['product_id']);echo($row['supplier_id'])?>"><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Quick View"><i
                                                                        class="ion-android-open"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                       <?php
                                    }
                                }
                                elseif (isset($_GET['cate']))
                                {
                                    //cate only
                                    $pro->setCateId($_GET['cate']);

                                    $totalRec = $pro->getAllWithCate(1);
                                    $total_cat_sub=mysqli_num_rows($totalRec);
                                    $total_pages = ceil($total_cat_sub/$record_per_page);

                                    $result = $pro->getAllWithCate(0);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $arrall[]=$row;
                                        $pro->setProId($row['product_id']);
                                        $pro->setSuppId($row['supplier_id']);
                                       ?>
                                            <div class="col-lg-4">
                                                <div class="product-slide_item">
                                                    <div class="inner-slide">
                                                        <div class="single-product">
                                                            <div class="product-img">
                                                            <?php
                                                                $pic1 = $pro->getSingleProductImages();
                                                                while ($rowimg1 = mysqli_fetch_assoc($pic1))
                                                                {
                                                                ?>
                                                                <a href="single-product-sale.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id']) ?>">
                                                                <?php
                                                                    if($rowimg1['status'] == 'primary')
                                                                    {
                                                                ?>
                                                                    <img class="primary-img" src="../public/assets/images/products/<?php echo($rowimg1['image_name']) ?>" alt="Uren's Product Thumnail">
                                                                    <?php
                                                                        }
                                                                        if($rowimg1['status'] == 'secondary')
                                                                        {
                                                                    ?>
                                                                    <img class="secondary-img" src="../public/assets/images/products/<?php echo($rowimg1['image_name']) ?>" alt="Uren's Product Thumnail">
                                                                    <?php
                                                                        }?>

                                                                </a>
                                                                    <?php
                                                                    }
                                                            ?>
                                                                <div class="sticker">
                                                                    <span class="sticker">New</span>
                                                                </div>
                                                                <div class="add-actions">
                                                                    <ul>
                                                                    <li><a class="uren-add_cart" href="cart.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id'])?>" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="ion-bag"></i></a></li>
                                                                        </li>
                                                                        <li><a class="uren-wishlist" href="wishlist.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id'])?>" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i
                                                                            class="ion-android-favorite-outline"></i></a>
                                                                        </li>

                                                                        <li class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter<?php echo($row['product_id']);echo($row['supplier_id'])?>"><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Quick View"><i
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
                                                                    <h6><a class="product-name" href="single-product-sale.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id']) ?>"><?php echo($row['name']) ?></a></h6>
                                                                    <div class="price-box">
                                                                        <span class="new-price"><?php echo('<b> '.$row['price'].' EGP</b>') ?></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="list-slide_item">
                                                    <div class="single-product">
                                                        <div class="product-img">
                                                            <?php
                                                                    $pic2 = $pro->getSingleProductImages();
                                                                    while ($rowimg2 = mysqli_fetch_assoc($pic2))
                                                                    {
                                                                    ?>
                                                                    <a href="single-product-sale.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id']) ?>">
                                                                    <?php
                                                                        if($rowimg2['status'] == 'primary')
                                                                        {
                                                                    ?>
                                                                        <img class="primary-img" src="../public/assets/images/products/<?php echo($rowimg2['image_name']) ?>" alt="Uren's Product Thumnail">
                                                                        <?php
                                                                            }
                                                                            if($rowimg2['status'] == 'secondary')
                                                                            {
                                                                        ?>
                                                                        <img class="secondary-img" src="../public/assets/images/products/<?php echo($rowimg2['image_name']) ?>" alt="Uren's Product Thumnail">
                                                                        <?php
                                                                            }?>

                                                                    </a>
                                                                        <?php
                                                                        }
                                                                ?>
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
                                                                <h6><a class="product-name" href="single-product.html"><?php echo($row['name']) ?></a></h6>
                                                                <div class="price-box">
                                                                    <span class="new-price"><?php echo('<b> '.$row['price'].' EGP</b>') ?></span>
                                                                </div>
                                                                <div class="product-short_desc">
                                                                    <p> <?php echo($row['detials'])?></p>
                                                                </div>
                                                            </div>
                                                            <div class="add-actions">
                                                                <ul>
                                                                    <li><a class="uren-add_cart" href="cart.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id'])?>" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="ion-bag"></i></a>
                                                                    </li>
                                                                    <li><a class="uren-wishlist" href="wishlist.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id'])?>" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                                    </li>

                                                                    <li class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter<?php echo($row['product_id']);echo($row['supplier_id'])?>"><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Quick View"><i
                                                                        class="ion-android-open"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                       <?php
                                    }
                                }
                                elseif (isset($_GET['key']))
                                {
                                    //key only
                                    $pro->setSearch($_GET['key']);
                                    $totalRec = $pro->searchAll(1);
                                    $total_cat_sub=mysqli_num_rows($totalRec);
                                    $total_pages = ceil($total_cat_sub/$record_per_page);

                                    $result = $pro->searchAll(0);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $arrall[]=$row;
                                        $pro->setProId($row['product_id']);
                                        $pro->setSuppId($row['supplier_id']);
                                       ?>
                                            <div class="col-lg-4">
                                                <div class="product-slide_item">
                                                    <div class="inner-slide">
                                                        <div class="single-product">
                                                            <div class="product-img">
                                                            <?php
                                                                $pic1 = $pro->getSingleProductImages();
                                                                while ($rowimg1 = mysqli_fetch_assoc($pic1))
                                                                {
                                                                ?>
                                                                <a href="single-product-sale.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id']) ?>">
                                                                <?php
                                                                    if($rowimg1['status'] == 'primary')
                                                                    {
                                                                ?>
                                                                    <img class="primary-img" src="../public/assets/images/products/<?php echo($rowimg1['image_name']) ?>" alt="Uren's Product Thumnail">
                                                                    <?php
                                                                        }
                                                                        if($rowimg1['status'] == 'secondary')
                                                                        {
                                                                    ?>
                                                                    <img class="secondary-img" src="../public/assets/images/products/<?php echo($rowimg1['image_name']) ?>" alt="Uren's Product Thumnail">
                                                                    <?php
                                                                        }?>

                                                                </a>
                                                                    <?php
                                                                    }
                                                            ?>
                                                                <div class="sticker">
                                                                    <span class="sticker">New</span>
                                                                </div>
                                                                <div class="add-actions">
                                                                    <ul>
                                                                    <li><a class="uren-add_cart" href="cart.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id'])?>" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="ion-bag"></i></a></li>
                                                                        </li>
                                                                        <li><a class="uren-wishlist" href="wishlist.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id'])?>" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i
                                                                            class="ion-android-favorite-outline"></i></a>
                                                                        </li>

                                                                        <li class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter<?php echo($row['product_id']);echo($row['supplier_id'])?>"><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Quick View"><i
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
                                                                    <h6><a class="product-name" href="single-product-sale.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id']) ?>"><?php echo($row['name']) ?></a></h6>
                                                                    <div class="price-box">
                                                                        <span class="new-price"><?php echo('<b> '.$row['price'].' EGP</b>') ?></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="list-slide_item">
                                                    <div class="single-product">
                                                        <div class="product-img">
                                                            <?php
                                                                    $pic2 = $pro->getSingleProductImages();
                                                                    while ($rowimg2 = mysqli_fetch_assoc($pic2))
                                                                    {
                                                                    ?>
                                                                    <a href="single-product-sale.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id']) ?>">
                                                                    <?php
                                                                        if($rowimg2['status'] == 'primary')
                                                                        {
                                                                    ?>
                                                                        <img class="primary-img" src="../public/assets/images/products/<?php echo($rowimg2['image_name']) ?>" alt="Uren's Product Thumnail">
                                                                        <?php
                                                                            }
                                                                            if($rowimg2['status'] == 'secondary')
                                                                            {
                                                                        ?>
                                                                        <img class="secondary-img" src="../public/assets/images/products/<?php echo($rowimg2['image_name']) ?>" alt="Uren's Product Thumnail">
                                                                        <?php
                                                                            }?>

                                                                    </a>
                                                                        <?php
                                                                        }
                                                                ?>
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
                                                                <h6><a class="product-name" href="single-product.html"><?php echo($row['name']) ?></a></h6>
                                                                <div class="price-box">
                                                                    <span class="new-price"><?php echo('<b> '.$row['price'].' EGP</b>') ?></span>
                                                                </div>
                                                                <div class="product-short_desc">
                                                                    <p> <?php echo($row['detials'])?></p>
                                                                </div>
                                                            </div>
                                                            <div class="add-actions">
                                                                <ul>
                                                                    <li><a class="uren-add_cart" href="cart.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id'])?>" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="ion-bag"></i></a>
                                                                    </li>
                                                                    <li><a class="uren-wishlist" href="wishlist.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id'])?>" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                                    </li>

                                                                    <li class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter<?php echo($row['product_id']);echo($row['supplier_id'])?>"><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Quick View"><i
                                                                        class="ion-android-open"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                       <?php
                                    }
                                }elseif (isset($_GET['brand_id'])) {
                                    //brand only
                                    $pro->setBrand($_GET['brand_id']);
                                    $totalRec = $pro->brandProducts(1);
                                    $total_cat_sub=mysqli_num_rows($totalRec);
                                    $total_pages = ceil($total_cat_sub/$record_per_page);


                                    $result = $pro->brandProducts(0);
                                    while ($row = mysqli_fetch_assoc($result))
                                    {
                                        $arrall[]=$row;
                                        $pro->setProId($row['product_id']);
                                        $pro->setSuppId($row['supplier_id']);
                                       ?>
                                            <div class="col-lg-4">
                                                <div class="product-slide_item">
                                                    <div class="inner-slide">
                                                        <div class="single-product">
                                                            <div class="product-img">
                                                            <?php
                                                                $pic1 = $pro->getSingleProductImages();
                                                                while ($rowimg1 = mysqli_fetch_assoc($pic1))
                                                                {
                                                                ?>
                                                                <a href="single-product-sale.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id']) ?>">
                                                                <?php
                                                                    if($rowimg1['status'] == 'primary')
                                                                    {
                                                                ?>
                                                                    <img class="primary-img" src="../public/assets/images/products/<?php echo($rowimg1['image_name']) ?>" alt="Uren's Product Thumnail">
                                                                    <?php
                                                                        }
                                                                        if($rowimg1['status'] == 'secondary')
                                                                        {
                                                                    ?>
                                                                    <img class="secondary-img" src="../public/assets/images/products/<?php echo($rowimg1['image_name']) ?>" alt="Uren's Product Thumnail">
                                                                    <?php
                                                                        }?>

                                                                </a>
                                                                    <?php
                                                                    }
                                                            ?>
                                                                <div class="sticker">
                                                                    <span class="sticker">New</span>
                                                                </div>
                                                                <div class="add-actions">
                                                                    <ul>
                                                                    <li><a class="uren-add_cart" href="cart.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id'])?>" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="ion-bag"></i></a></li>
                                                                        </li>
                                                                        <li><a class="uren-wishlist" href="wishlist.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id'])?>" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i
                                                                            class="ion-android-favorite-outline"></i></a>
                                                                        </li>

                                                                        <li class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter<?php echo($row['product_id']);echo($row['supplier_id'])?>"><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Quick View"><i
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
                                                                    <h6><a class="product-name" href="single-product-sale.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id']) ?>"><?php echo($row['name']) ?></a></h6>
                                                                    <div class="price-box">
                                                                        <span class="new-price"><?php echo('<b> '.$row['price'].' EGP</b>') ?></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="list-slide_item">
                                                    <div class="single-product">
                                                        <div class="product-img">
                                                            <?php
                                                                    $pic2 = $pro->getSingleProductImages();
                                                                    while ($rowimg2 = mysqli_fetch_assoc($pic2))
                                                                    {
                                                                    ?>
                                                                    <a href="single-product-sale.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id']) ?>">
                                                                    <?php
                                                                        if($rowimg2['status'] == 'primary')
                                                                        {
                                                                    ?>
                                                                        <img class="primary-img" src="../public/assets/images/products/<?php echo($rowimg2['image_name']) ?>" alt="Uren's Product Thumnail">
                                                                        <?php
                                                                            }
                                                                            if($rowimg2['status'] == 'secondary')
                                                                            {
                                                                        ?>
                                                                        <img class="secondary-img" src="../public/assets/images/products/<?php echo($rowimg2['image_name']) ?>" alt="Uren's Product Thumnail">
                                                                        <?php
                                                                            }?>

                                                                    </a>
                                                                        <?php
                                                                        }
                                                                ?>
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
                                                                <h6><a class="product-name" href="single-product.html"><?php echo($row['name']) ?></a></h6>
                                                                <div class="price-box">
                                                                    <span class="new-price"><?php echo('<b> '.$row['price'].' EGP</b>') ?></span>
                                                                </div>
                                                                <div class="product-short_desc">
                                                                    <p> <?php echo($row['detials'])?></p>
                                                                </div>
                                                            </div>
                                                            <div class="add-actions">
                                                                <ul>
                                                                    <li><a class="uren-add_cart" href="cart.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id'])?>" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="ion-bag"></i></a>
                                                                    </li>
                                                                    <li><a class="uren-wishlist" href="wishlist.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id'])?>" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                                    </li>

                                                                    <li class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter<?php echo($row['product_id']);echo($row['supplier_id'])?>"><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Quick View"><i
                                                                        class="ion-android-open"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                       <?php
                                    }
                                }
                                elseif (isset($_GET['off']))
                                {
                                    //cate only
                                    $pro->setOffer($_GET['off']);
                                    $totalRec = $pro->offeredProducts(1);
                                    $total_cat_sub=mysqli_num_rows($totalRec);
                                    $total_pages = ceil($total_cat_sub/$record_per_page);

                                    $result = $pro->offeredProducts(0);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        // $arrall[]=$row;
                                        $pro->setProId($row['product_id']);
                                        $pro->setSuppId($row['supp_id']);
                                       ?>
                                            <div class="col-lg-4">
                                                <div class="product-slide_item">
                                                    <div class="inner-slide">
                                                        <div class="single-product">
                                                            <div class="product-img">
                                                            <?php
                                                                $pic1 = $pro->getSingleProductImages();
                                                                while ($rowimg1 = mysqli_fetch_assoc($pic1))
                                                                {
                                                                ?>
                                                                <a href="single-product-sale.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supp_id']) ?>">
                                                                <?php
                                                                    if($rowimg1['status'] == 'primary')
                                                                    {
                                                                ?>
                                                                    <img class="primary-img" src="../public/assets/images/products/<?php echo($rowimg1['image_name']) ?>" alt="Uren's Product Thumnail">
                                                                    <?php
                                                                        }
                                                                        if($rowimg1['status'] == 'secondary')
                                                                        {
                                                                    ?>
                                                                    <img class="secondary-img" src="../public/assets/images/products/<?php echo($rowimg1['image_name']) ?>" alt="Uren's Product Thumnail">
                                                                    <?php
                                                                        }?>

                                                                </a>
                                                                    <?php
                                                                    }
                                                            ?>
                                                                <div class="sticker">
                                                                <span class="sticker" style="background:#0886cf"><?php echo(($row['percentage']+$row['discount'])*100) ?> %</span>
                                                                </div>
                                                                <div class="add-actions">
                                                                    <ul>
                                                                    <li><a class="uren-add_cart" href="cart.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supp_id'])?>" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="ion-bag"></i></a></li>
                                                                        </li>
                                                                        <li><a class="uren-wishlist" href="wishlist.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supp_id'])?>" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i
                                                                            class="ion-android-favorite-outline"></i></a>
                                                                        </li>

                                                                        <!-- <li class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter<?php echo($row['product_id']);echo($row['supp_id'])?>"><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Quick View"><i
                                                                            class="ion-android-open"></i></a></li> -->
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
                                                                    <h6><a class="product-name" href="single-product-sale.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supp_id']) ?>"><?php echo($row['name']) ?></a></h6>
                                                                    <div class="price-box">
                                                                        <span class="new-price"><?php echo('<b> '.$row['price'].' EGP</b>') ?></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="list-slide_item">
                                                    <div class="single-product">
                                                        <div class="product-img">
                                                            <?php
                                                                    $pic2 = $pro->getSingleProductImages();
                                                                    while ($rowimg2 = mysqli_fetch_assoc($pic2))
                                                                    {
                                                                    ?>
                                                                    <a href="single-product-sale.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supp_id']) ?>">
                                                                    <?php
                                                                        if($rowimg2['status'] == 'primary')
                                                                        {
                                                                    ?>
                                                                        <img class="primary-img" src="../public/assets/images/products/<?php echo($rowimg2['image_name']) ?>" alt="Uren's Product Thumnail">
                                                                        <?php
                                                                            }
                                                                            if($rowimg2['status'] == 'secondary')
                                                                            {
                                                                        ?>
                                                                        <img class="secondary-img" src="../public/assets/images/products/<?php echo($rowimg2['image_name']) ?>" alt="Uren's Product Thumnail">
                                                                        <?php
                                                                            }?>

                                                                    </a>
                                                                        <?php
                                                                        }
                                                                ?>
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
                                                                <h6><a class="product-name" href="single-product.html"><?php echo($row['name']) ?></a></h6>
                                                                <div class="price-box">
                                                                    <span class="new-price"><?php echo('<b> '.$row['price'].' EGP</b>') ?></span>
                                                                </div>
                                                                <div class="product-short_desc">
                                                                    <p> <?php echo($row['detials'])?></p>
                                                                </div>
                                                            </div>
                                                            <div class="add-actions">
                                                                <ul>
                                                                    <li><a class="uren-add_cart" href="cart.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supp_id'])?>" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="ion-bag"></i></a>
                                                                    </li>
                                                                    <li><a class="uren-wishlist" href="wishlist.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supp_id'])?>" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                                    </li>

                                                                    <!-- <li class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter<?php echo($row['product_id']);echo($row['supp_id'])?>"><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Quick View"><i
                                                                        class="ion-android-open"></i></a>
                                                                    </li> -->
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                       <?php
                                    }

                                }
                                else
                                {
                                    $totalRec = $pro->getAllProducts(1);
                                    $total_cat_sub=mysqli_num_rows($totalRec);
                                    $total_pages = ceil($total_cat_sub/$record_per_page);
                                    $result = $pro->getAllProducts(0);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $arrall[]=$row;
                                        $pro->setProId($row['product_id']);
                                        $pro->setSuppId($row['supplier_id']);
                                       ?>
                                            <div class="col-lg-4">
                                                <div class="product-slide_item">
                                                    <div class="inner-slide">
                                                        <div class="single-product">
                                                            <div class="product-img">
                                                            <?php
                                                                $pic1 = $pro->getSingleProductImages();
                                                                while ($rowimg1 = mysqli_fetch_assoc($pic1))
                                                                {
                                                                ?>
                                                                <a href="single-product-sale.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id']) ?>">
                                                                <?php
                                                                    if($rowimg1['status'] == 'primary')
                                                                    {
                                                                ?>
                                                                    <img class="primary-img" src="../public/assets/images/products/<?php echo($rowimg1['image_name']) ?>" alt="Uren's Product Thumnail">
                                                                    <?php
                                                                        }
                                                                        if($rowimg1['status'] == 'secondary')
                                                                        {
                                                                    ?>
                                                                    <img class="secondary-img" src="../public/assets/images/products/<?php echo($rowimg1['image_name']) ?>" alt="Uren's Product Thumnail">
                                                                    <?php
                                                                        }?>

                                                                </a>
                                                                    <?php
                                                                    }
                                                            ?>
                                                                <div class="sticker">
                                                                    <span class="sticker">New</span>
                                                                </div>
                                                                <div class="add-actions">
                                                                    <ul>
                                                                    <li><a class="uren-add_cart" href="cart.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id'])?>" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="ion-bag"></i></a></li>
                                                                        </li>
                                                                        <li><a class="uren-wishlist" href="wishlist.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id'])?>" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i
                                                                            class="ion-android-favorite-outline"></i></a>
                                                                        </li>

                                                                        <li class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter<?php echo($row['product_id']);echo($row['supplier_id'])?>"><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Quick View"><i
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
                                                                    <h6><a class="product-name" href="single-product-sale.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id']) ?>"><?php echo($row['name']) ?></a></h6>
                                                                    <div class="price-box">
                                                                        <span class="new-price"><?php echo('<b> '.$row['price'].' EGP</b>') ?></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="list-slide_item">
                                                    <div class="single-product">
                                                        <div class="product-img">
                                                            <?php
                                                                    $pic2 = $pro->getSingleProductImages();
                                                                    while ($rowimg2 = mysqli_fetch_assoc($pic2))
                                                                    {
                                                                    ?>
                                                                    <a href="single-product-sale.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id']) ?>">
                                                                    <?php
                                                                        if($rowimg2['status'] == 'primary')
                                                                        {
                                                                    ?>
                                                                        <img class="primary-img" src="../public/assets/images/products/<?php echo($rowimg2['image_name']) ?>" alt="Uren's Product Thumnail">
                                                                        <?php
                                                                            }
                                                                            if($rowimg2['status'] == 'secondary')
                                                                            {
                                                                        ?>
                                                                        <img class="secondary-img" src="../public/assets/images/products/<?php echo($rowimg2['image_name']) ?>" alt="Uren's Product Thumnail">
                                                                        <?php
                                                                            }?>

                                                                    </a>
                                                                        <?php
                                                                        }
                                                                ?>
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
                                                                <h6><a class="product-name" href="single-product.html"><?php echo($row['name']) ?></a></h6>
                                                                <div class="price-box">
                                                                    <span class="new-price"><?php echo('<b> '.$row['price'].' EGP</b>') ?></span>
                                                                </div>
                                                                <div class="product-short_desc">
                                                                    <p> <?php echo($row['detials'])?></p>
                                                                </div>
                                                            </div>
                                                            <div class="add-actions">
                                                                <ul>
                                                                    <li><a class="uren-add_cart" href="cart.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id'])?>" data-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="ion-bag"></i></a>
                                                                    </li>
                                                                    <li><a class="uren-wishlist" href="wishlist.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id'])?>" data-toggle="tooltip" data-placement="top" title="Add To Wishlist"><i
                                                                        class="ion-android-favorite-outline"></i></a>
                                                                    </li>

                                                                    <li class="quick-view-btn" data-toggle="modal" data-target="#exampleModalCenter<?php echo($row['product_id']);echo($row['supplier_id'])?>"><a href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Quick View"><i
                                                                        class="ion-android-open"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                       <?php
                                    }
                                }
                            ?>



                        </div>
                        <?php
                        foreach ($arrall as $value) {
                            $pro->setProId($value['product_id']);
                            $pro->setSuppId($value['supplier_id']);
                            include "modal.php";
                        }
                        ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="uren-paginatoin-area">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <ul class="uren-pagination-box primary-color">
                                                <?php
                                                if(isset($_GET['cate']) && isset($_GET['sub']))
                                                {

                                                    for($i=1;$i<=$total_pages;$i++){
                                                        ?>
                                                             <!-- <li class="active"><a href="javascript:void(0)">1</a></li> -->
                                                            <li class = "<?php if(!isset($_GET['page']) && $i ==1){echo('active');}elseif($i == $_GET['page']){echo('active');} ?>"><a  href="allproducts.php?cate=<?php echo($_GET['cate']) ?>&sub=<?php echo($_GET['sub']) ?>&page=<?php echo($i) ?>"><?php echo($i) ?></a></li>
                                                        <?php
                                                    }

                                                }
                                                if(isset($_GET['cate']))
                                                {

                                                    for($i=1;$i<=$total_pages;$i++){
                                                        ?>
                                                             <!-- <li class="active"><a href="javascript:void(0)">1</a></li> -->
                                                            <li class = "<?php if(!isset($_GET['page']) && $i ==1){echo('active');}elseif($i == $_GET['page']){echo('active');} ?>"><a  href="allproducts.php?cate=<?php echo($_GET['cate']) ?>&page=<?php echo($i) ?>"><?php echo($i) ?></a></li>
                                                        <?php
                                                    }

                                                }
                                                elseif (isset($_GET['key']))
                                                {
                                                    for($i=1;$i<=$total_pages;$i++){
                                                        ?>
                                                             <!-- <li class="active"><a href="javascript:void(0)">1</a></li> -->
                                                            <li class = "<?php if(!isset($_GET['page']) && $i ==1){echo('active');}elseif($i == $_GET['page']){echo('active');} ?>"><a  href="allproducts.php?key=<?php echo($_GET['key']) ?>&page=<?php echo($i) ?>"><?php echo($i) ?></a></li>
                                                        <?php
                                                    }
                                                }
                                                elseif (isset($_GET['brand_id']))
                                                {
                                                    for($i=1;$i<=$total_pages;$i++){
                                                        ?>
                                                             <!-- <li class="active"><a href="javascript:void(0)">1</a></li> -->
                                                            <li class = "<?php if(!isset($_GET['page']) && $i ==1){echo('active');}elseif($i == $_GET['page']){echo('active');} ?>"><a  href="allproducts.php?brand_id=<?php echo($_GET['brand_id']) ?>&page=<?php echo($i) ?>"><?php echo($i) ?></a></li>
                                                        <?php
                                                    }
                                                }
                                                elseif (isset($_GET['off']))
                                                {
                                                    for($i=1;$i<=$total_pages;$i++){
                                                        ?>
                                                             <!-- <li class="active"><a href="javascript:void(0)">1</a></li> -->
                                                            <li class = "<?php if(!isset($_GET['page']) && $i ==1){echo('active');}elseif($i == $_GET['page']){echo('active');} ?>"><a  href="allproducts.php?off=<?php echo($_GET['off']) ?>&page=<?php echo($i) ?>"><?php echo($i) ?></a></li>
                                                        <?php
                                                    }
                                                }else{
                                                    for($i=1;$i<=$total_pages;$i++){
                                                        ?>
                                                             <!-- <li class="active"><a href="javascript:void(0)">1</a></li> -->
                                                            <li class = "<?php if(!isset($_GET['page']) && $i ==1){echo('active');}elseif($i == $_GET['page']){echo('active');} ?>"><a  href="allproducts.php?page=<?php echo($i) ?>"><?php echo($i) ?></a></li>
                                                        <?php
                                                    }
                                                }
                                                ?>
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
        <!-- Uren's Shop Left Sidebar Area End Here -->
        <?php include "footer.php"; ?>
