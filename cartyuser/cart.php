<?php
ob_start();
session_start();
if(isset($_SESSION['username'])){
    include "headerafter.php";
    // header("Refresh:0");
}else{
    include "headerbefore.php";
    // header("Refresh:0");
    }
    ?>
    <!-- Begin Uren's Breadcrumb Area -->
    <!-- <div class="breadcrumb-area">
            <div class="container">
                <div class="breadcrumb-content">
                    <h2>Other</h2>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li class="active">Cart</li>
                    </ul>
                </div>
            </div>
        </div> -->
    <!-- Uren's Breadcrumb Area End Here -->
    <!-- Begin Uren's Cart Area -->
    <div class="uren-cart-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="table-content table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th> Item </th>
                                    <th class="uren-product-thumbnail">image</th>
                                    <th class="cart-product-name">Product</th>
                                    <th class="uren-product-price">Unit Price</th>
                                    <th class="uren-product-quantity">Quantity</th>
                                    <th class="uren-product-subtotal">Total</th>
                                    <th class="uren-product-remove">remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                            if(isset($_SESSION['username'])){
                                                    /* add to cart from index hadeer */
                                                    include_once "products.php";
                                                    $single = new products();
                                                    if (isset($_GET['pro']) && isset($_GET['supp']) ) {
                                                    $single->setProId($_GET['pro']);
                                                    $single->setSuppId($_GET['supp']);
                                                    $result = $single->getSingleProduct();
                                                    // echo($result);
                                                        if($rows= mysqli_fetch_assoc($result)) {

                                                                    include_once "temp_cart.php";
                                                                    $cart = new temp_cart();
                                                                    $cart->setProId($_GET['pro']);
                                                                    $cart->setSuppId($_GET['supp']);
                                                                    $cart->setUserId($_SESSION['userid']);
                                                                    $cart->setQuantity('1');
                                                                    $cart->setProName($rows['name']);
                                                                    $cart->setPrice($rows['price']);
                                                                    $response = $cart->add();

                                                                    if($response != 'ok'){
                                                                        $response1 = $cart->update();
                                                                    }

                                                        }
                                                    }
                                                    /* end add to cart from index hadeer */

                                                include_once "temp_cart.php";
                                                $cart = new temp_cart();
                                                $cart->setUserId($_SESSION['userid']);
                                                $res = $cart->getAll();
                                                $x= 1;
                                                $total = 0;
                                                while($row = mysqli_fetch_assoc($res))
                                                {

                                        ?>
                                    <tr class="rem<?php echo($x)?>">
                                        <td>
                                            <?php echo($x)?>
                                        </td>
                                        <td class="uren-product-thumbnail">
                                            <?php
                                                    $single->setProId($row['product_id']);
                                                    $single->setSuppId($row['supplier_id']);
                                                    $pic1 = $single->getSingleProductImages();
                                                    if ($rowi = mysqli_fetch_assoc($pic1))
                                                    {
                                                ?>
                                                <a href="single-product-sale.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id']) ?>">
                                                    <?php
                                                        if($rowi['status'] == 'primary')
                                                        {
                                                        ?>
                                                        <img src="../public/assets/images/products/<?php echo($rowi['image_name']) ?>" alt="Uren's Cart Thumbnail" style="width: 100px; height:100px">
                                                        <?php
                                                    }
                                                ?>
                                                </a>
                                                <?php
                                                }?>
                                        </td>
                                        <td class="uren-product-name">
                                            <a href="single-product-sale.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id']) ?>">
                                                <?php $price= $row['product_name'] ;echo($price); ?>
                                            </a>
                                        </td>

                                                <input type="hidden" name="pro<?php echo($x) ?>" value="<?php echo($row['product_id']) ?>" id="pro<?php echo($x) ?>">
                                                <input type="hidden" name="supp<?php echo($x) ?>" value="<?php echo($row['supplier_id']) ?>" id="supp<?php echo($x) ?>">

                                        <td class="uren-product-price"><span class="amount" id="price<?php echo($x)?>"><?php echo($row['price']) ?></span> EGP</td>
                                        <td class="quantity">
                                            <label>Quantity</label>
                                            <div class="cart-plus-minus">
                                                <input class="cart-plus-minus-box" value="<?php $quantity = $row['quantity'];  echo($quantity); ?>" type="number" name="quantity<?php echo($x)?>" id="quantity<?php echo($x)?>">
                                                <div class="dec qtybutton" style="z-index:10" id="inc<?php echo($x)?>"><i class="fa fa-angle-down"></i></div>
                                                <div class="inc qtybutton" style="z-index:10" id="dec<?php echo($x)?>"><i class="fa fa-angle-up"></i></div>
                                            </div>
                                        </td>
                                        <td class="product-subtotal"><span class="amount" id="subtotal<?php echo($x)?>"><?php $sub =  $row['quantity'] * $row['price']; $total+=$sub; echo($sub);?></span> EGP</td>
                                        <form method="POST">
                                            <td class="uren-product-remove"><a href="javascript:void(0)">
                                                <input style="display: none" type="submit" name="txtclose<?php echo($x)?>" class="txtclose<?php echo($x)?>"><i class="fa fa-trash close<?php echo($x)?>"
                                                title="Remove"></i></a></td>
                                        </form>
                                    </tr>
                                    <script>
                                        $(document).ready(function(c) {
                                            // remove product from cart
                                            $('.close<?php echo($x)?>').on('click', function(c) {
                                                $('.txtclose<?php echo($x)?>').click();
                                                $('.rem<?php echo($x)?>').fadeOut('slow', function(c) {
                                                    $('.rem<?php echo($x)?>').remove();
                                                });
                                            });
                                            // update quantity on keyup
                                            $('#quantity<?php echo($x)?>').on({
                                                keyup: function() {
                                                    var quantity = $(this).val();
                                                    var price = $('#price<?php echo($x)?>').html();
                                                    var subtotal = price * quantity;
                                                    $('#subtotal<?php echo($x)?>').html(subtotal.toFixed(2));

                                                }
                                            });
                                            // update quantity on click
                                            $('#inc<?php echo($x)?>,#dec<?php echo($x)?>').on({
                                                click: function() {
                                                    var quantity = $('#quantity<?php echo($x)?>').val();
                                                    var price = $('#price<?php echo($x)?>').html();
                                                    var subtotal = price * quantity;
                                                    $('#subtotal<?php echo($x)?>').html(subtotal.toFixed(2));
                                                }
                                            });
                                        });
                                    </script>

                                        <?php
                                        if(isset($_POST['txtclose'.$x])){
                                            $cart->setProId($row['product_id']);
                                            $cart->setSuppId($row['supplier_id']);
                                            $cart->delete();
                                            header('refresh:0');
                                        }

                                        ?>

                                        <?php

                                        $x++;
                                        }
                                    }else
                                    {
                                    /* add to cart from index hadeer */
                                    include_once "products.php";
                                    $single = new products();
                                    $total=0;
                                    if (isset($_GET['pro']) && isset($_GET['supp']) ) {
                                    $single->setProId($_GET['pro']);
                                    $single->setSuppId($_GET['supp']);
                                    $result = $single->getSingleProduct();
                                    // echo($result);
                                    if($rows= mysqli_fetch_assoc($result)){

                                        if(isset($_COOKIE["cart"])){
                                            $cookie_data = stripcslashes($_COOKIE['cart']);
                                            $cart_data=json_decode($cookie_data,true);
                                        }else

                                        $cart_data=array();
                                        $item_id_list = array_column($cart_data, 'product_id');
                                    if(in_array($_GET['pro'], $item_id_list))
                                    {
                                     foreach($cart_data as $keys => $values)
                                     {
                                      if($cart_data[$keys]["product_id"] == $_GET['pro'])
                                      {
                                       $cart_data[$keys]["quantity"]=$cart_data[$keys]["quantity"]+ 1;
                                      }
                                     }
                                    }
                                    else
                                    {
                                     $item_array = array(
                                        'product_id' => $_GET['pro'],
                                        'supplier_id' => $_GET['supp'],
                                        'quantity' => '1',
                                        'product_name' => $rows['name'],
                                        'price' => $rows['price'],

                                     );
                                     $cart_data[] = $item_array;
                                    }
                                    $item_data = json_encode($cart_data);
                                    setcookie('cart', $item_data, time() + (86400 * 30));
                                    header('location:cart.php');

                                    }

                                }
                            }
                            if(isset($_COOKIE["cart"]))
                            {
                                        $cookie_data = stripcslashes($_COOKIE['cart']);
                                        $cart_data=json_decode($cookie_data,true);
                                        $total=0;
                                        $x=1;
                                        foreach($cart_data as $keys => $values)
                                        {
                                            ?>

                                            <tr class="rem<?php echo($x)?>">
                                                <td>
                                                    <?php echo($x)?>
                                                </td>
                                                <td class="uren-product-thumbnail">
                                                    <a href="single-product-sale.php?pro=<?php echo($values['product_id']) ?>&supp=<?php echo($values['supplier_id']) ?>">
                                                        <?php
                                                include_once "products.php";
                                                $pro = new products();
                                                $pro->setProId($values['product_id']);
                                                $pro->setSuppId($values['supplier_id']);
                                                $pic1 = $pro->getSingleProductImages();
                                                if ($rowimg1 = mysqli_fetch_assoc($pic1))
                                                {
                                                    if($rowimg1['status'] == 'primary')
                                                    {
                                                ?>
                                                            <img src="../public/assets/images/products/<?php echo($rowimg1['image_name']) ?>" alt="Uren's Cart Thumbnail" style="width:100px; height:100px;">
                                                            <?php
                                                    }
                                                }
                                            ?>
                                                    </a>
                                                </td>
                                                <td class="uren-product-name">
                                                    <a href="single-product-sale.php?pro=<?php echo($values['product_id']) ?>&supp=<?php echo($values['supplier_id']) ?>">
                                                        <?php $price= $values['product_name'] ;echo($price); ?>
                                                    </a>
                                                </td>
                                                <td class="uren-product-price"><span class="amount"><?php echo($values['price'].' EGP') ?></span></td>
                                                <td class="quantity">
                                                    <label>Quantity</label>
                                                    <div class="cart-plus-minus">
                                                        <input class="cart-plus-minus-box" value="<?php $quantity = $values['quantity'];  echo($quantity); ?>" type="number" id="qty<?php echo($x) ?>" name="quantity">
                                                        <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                                        <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                                    </div>
                                                </td>
                                                <td class="product-subtotal"><span class="amount"><?php $sub =  $values['quantity'] * $values['price']; $total+=$sub; echo($sub.' EGP');?></span></td>
                                                <form method="post">
                                                <td class="uren-product-remove"><a href="cart.php?action=delete&id=<?php echo $values[" product_id "]; ?>">
                                            <input style="display:none;" type="submit" name="submit<?php echo($x)?>" class="submit<?php echo($x)?>" id="">
                                            <i class="fa fa-trash close<?php echo($x)?>"
                                            title="Remove"></i></a></td>
                                            </tr>

                                            <?php
                                        if(isset($_GET["action"]))
                                        {
                                        if($_GET["action"] == "delete")
                                        {
                                            $cookie_data = stripcslashes($_COOKIE['cart']);
                                            $cart_data=json_decode($cookie_data,true);
                                            foreach($cart_data as $keys => $values)
                                            {
                                                if($cart_data[$keys]['product_id'] == $_GET['id'])
                                                {
                                                unset($cart_data[$keys]);
                                                $item_data = json_encode($cart_data);
                                                setcookie("cart", $item_data, time() + (86400 * 30));
                                                header("location:cart.php?remove=1");
                                                }
                                            }
                                        }
                                    }

                                            $x++;
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="coupon-all">
                                <div class="coupon">
                                    <input id="coupon_code" class="input-text" name="coupon_code" value="" placeholder="Coupon code" type="text">
                                    <input class="button" name="apply_coupon" value="Apply coupon" type="submit">
                                </div>
                                <form method="post" id="form">
                                            <div class="coupon2">
                                                <?php
                                            //    echo($x);
                                                for($i = 1 ; $i<$x ;$i++){
                                                    ?>
                                                    <input type="hidden" name="quantityy<?php echo($i) ?>" id="quantityy<?php echo($i) ?>">
                                                    <input type="hidden" name="pro_id<?php echo($i) ?>" id="pro_id<?php echo($i) ?>">
                                                    <input type="hidden" name="supp_id<?php echo($i) ?>" id="supp_id<?php echo($i) ?>">
                                                    <script>
                                                        $(document).ready(function(){
                                                            $("#form").submit(function(e){
                                                                var test = $('#quantity<?php echo($i) ?>').val();
                                                                $('#quantityy<?php echo($i) ?>').val(test);

                                                                var testpro = $('#pro<?php echo($i) ?>').val();
                                                                $('#pro_id<?php echo($i) ?>').val(testpro);

                                                                var testsupp = $('#supp<?php echo($i) ?>').val();
                                                                $('#supp_id<?php echo($i) ?>').val(testsupp);
                                                            });

                                                        });

                                                    </script>

                                                    <?php
                                                    if(isset($_POST['update_cart'])){
                                                        include_once "temp_cart.php";
                                                        $qty = new temp_cart();
                                                        $qty->setQuantity($_POST['quantityy'.$i]);
                                                        $qty->setProId($_POST['pro_id'.$i]);
                                                        $qty->setSuppId($_POST['supp_id'.$i]);
                                                        $qty->setUserId($_SESSION['userid']);
                                                        $up = $qty->updateqty();
                                                        if($up == 'ok'){
                                                            echo($up);

                                                        }
                                                        else{
                                                            echo($up);
                                                        }

                                                    }
                                                }
                                                if(isset($_POST['update_cart'])){
                                                    header('Refresh:0');
                                                }
                                                ?>
                                                <input class="button" name="update_cart" value="Update cart" type="submit">
                                            </div>
                                        </form>
                                <?php

                                        ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 ml-auto">
                            <div class="cart-page-total">
                                <h2>Cart totals</h2>
                                <ul>
                                    <li>Subtotal <span><?php echo($total .' EGP') ?></span></li>
                                    <li>Tax Percentage<span>14 % </span></li>
                                    <li>Tax Value<span> <?php $taxValue = $total*.14; echo(round($taxValue,2).' EGP') ?> </span></li>
                                    <li>Shipping <span> 20 EGP </span></li>
                                    <li></li>
                                    <li class="text-danger">Total <span> <?php $finalTotal = $taxValue + $total + 20; echo(round($finalTotal,2).' EGP') ?> </span></li>
                                </ul>
                                <a href="checkout.php">Proceed to checkout</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Uren's Cart Area End Here -->
    <?php include "footer.php"; ?>
        <!-- <script>
            $(document).ready(function(c) {
            $('.close1').on('click', function(c){
                $('.rem1').fadeOut('slow', function(c){
                    $('.rem1').remove();
                });
                });
            });
        </script> -->
