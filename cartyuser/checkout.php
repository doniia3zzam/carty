<?php
ob_start();
session_start();
if(isset($_SESSION['username'])){
    include "headerafter.php";
}else{
    include "headerbefore.php";
    header('location:login.php');
    } ?>
        <div class="breadcrumb-area">
            <div class="container">
                <div class="breadcrumb-content">
                    <h2>Other</h2>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li class="active">Checkout</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Uren's Breadcrumb Area End Here -->
        <!-- Begin Uren's Checkout Area -->
        <div class="checkout-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="coupon-accordion">
                            <!-- <h3>Returning customer? <span id="showlogin">Click here to login</span></h3>
                            <div id="checkout-login" class="coupon-content">
                                <div class="coupon-info">
                                <?php


                                        // echo($_SESSION['userid']);
                                        include_once "customer.php";
                                        $cust = new customer();
                                        $cust->setId($_SESSION['userid']);
                                        $result = $cust->getaddress();

                                       $row = mysqli_fetch_assoc($result) ;
                                            // echo("hello");
                                            // $addressID = '';
                                            ?>
                                    <p class="coupon-text">.</p>
                                    <form action="javascript:void(0)">
                                        <p class="form-row-first">
                                            <label>Username  <span class="required">*</span></label>
                                            <label > <?php echo($_SESSION['username']) ?></label>
                                        </p>
                                        <p class="form-row-last">
                                            <label>Password <span class="required">*</span></label>
                                            <input type="password" class="form-control" value="<?php echo($row['password']) ?>" >
                                        </p>
                                        <p class="form-row">
                                            <input value="Login" type="submit">
                                            <label>
                                                <input type="checkbox">
                                                Remember me
                                            </label>
                                        </p>
                                        <p class="lost-password"><a href="javascript:void(0)">Lost your password?</a></p>
                                    </form>
                                </div>
                            </div> -->
                            <h3>Have a coupon? <span id="showcoupon">Click here to enter your code</span></h3>
                            <div id="checkout_coupon" class="coupon-checkout-content">
                                <div class="coupon-info">
                                    <form action="javascript:void(0)">
                                        <p class="checkout-coupon">
                                            <input placeholder="Coupon code" type="text">
                                            <input class="coupon-inner_btn" value="Apply Coupon" type="submit">
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="your-order">
                        <form method="post">
                            <h3>ship to your adress</h3>
                            <div>
                                <table class="table">

                                        <tr>
                                            <th class="cart-product-name">Username</th>
                                            <td class="cart-product-total"><?php echo($_SESSION['username']) ?></td>
                                        </tr>

                                        <tr class="cart_item">
                                            <th class="cart-product-name">Phone </th>
                                            <td class="cart-product-total"><?php echo($row['phone']) ?></td>
                                        </tr>
                                        <tr class="cart_item">
                                            <th class="cart-product-name">Email</th>
                                            <td class="cart-product-total"><?php echo($row['email']) ?></td>
                                        </tr>
                                        <?php if($row['lat'] == ""){ ?>
                                        <tr class="cart_item">
                                            <th class="cart-product-name">Address </th>
                                            <td class="cart-product-total"><?php echo($row['city']) ?>-<?php echo($row['area']) ?>-<?php echo($row['customerAddress']) ?></td>
                                        </tr>
                                        <?php }else{
                                            ?>
                                            <tr class="cart_item">
                                                <th>Location:</th>
                                                <td> Set By Google Maps </td>
                                            </tr>
                                            <?php
                                        } ?>


                                </table>
                            </div>

                                    <div class="bg-dark form-control text-center">

                                    <a href="myaccount.php?check=1">change address</a>

                                    </div>
                        </div>
                    </div>


                    <div class="col-lg-6 col-12">
                        <div class="your-order">
                            <h3>Your order</h3>
                            <div class="your-order-table table-responsive text-center">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="cart-product-name">id</th>
                                            <th class="cart-product-total">product</th>
                                            <th class="cart-product-name">name</th>
                                            <th class="cart-product-total">quantity</th>
                                            <th class="cart-product-total">price</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                            //inserting order
                                            $lastOrder;
                                        if(isset($_POST['sub'])){
                                                include_once "order.php";
                                                $or = new order();
                                                $or->setcustomerId($row['addressId']);
                                                $or->setdelivaryId('1');
                                                $or->settotal($total+20+$total*.14);
                                                $or->setpaymentId($_POST['payrad']);
                                                $success = $or->setOrder();
                                                if($success == 'ok'){
                                                    echo('<div class="alert alert-info text-center" role="alert">Order successfully checked, you can Follow your order</div>');
                                                    // header('Refresh:2; url=myorders.php');
                                                }else{
                                                    echo('<div class="alert alert-danger" role="alert">Some thing Went Wrong</div>');
                                                }
                                                $lastOrder = $or->getLastId();
                                                // echo($lastOrder);
                                            }



                                            include_once "temp_cart.php";
                                            $cart = new temp_cart();
                                            $cart->setUserId($_SESSION['userid']);
                                            $res = $cart->getAll();
                                            $x= 1;
                                            $total = 0;
                                            // $finalTotal = 0;
                                            while($row = mysqli_fetch_assoc($res)){


                                        ?>
                                        <tr class="cart_item">
                                            <td class="cart-product-total"> <?php echo($row['product_id']) ?></td>
                                            <td class="cart-product-total">
                                            <?php

                                                include_once "products.php";
                                                $pro = new products();
                                                $pro->setProId($row['product_id']);
                                                $pro->setSuppId($row['supplier_id']);
                                                $pic1 = $pro->getSingleProductImages();
                                                if ($rowimg1 = mysqli_fetch_assoc($pic1))
                                                {

                                                        if($rowimg1['status'] == 'primary')
                                                            {
                                                    ?>
                                                     <img src="../public/assets/images/products/<?php echo($rowimg1['image_name']) ?>" style="width:50px; height:50px;" alt="Uren's Cart Thumbnail">
                                                <?php
                                                            }
                                                        }
                                                ?>
                                            </td>
                                            <td class="cart-product-total"> <?php echo $row['product_name'] ?></td>
                                            <td class="cart-product-total">  <?php echo $row['quantity'] ?></td>
                                            <td class="cart-product-total"> <?php echo($row['price'].' EGP') ?></td>
                                            <?php $total+=$row['price']*$row['quantity']; ?>
                                        </tr>


                                            <?php
                                        //inserting ordered_products
                                        if(isset($_POST['sub'])){
                                            include_once "order.php";
                                            $or = new order();
                                            $or->setProId($row['product_id']);
                                            $or->setSuppId($row['supplier_id']);
                                            $or->setOrderId($lastOrder);
                                            $or->setPrice($row['price']);
                                            $or->setQuantity($row['quantity']);
                                            $res3 = $or->setProducts();
                                            include_once "temp_cart.php";
                                            $cart = new temp_cart();
                                            $cart->removeMyCart($_SESSION['userid']);
                                            header('Refresh:2; url=bill.php?id='.$lastOrder);
                                            // echo($res3);


                                        }




                                        }



                                        ?>


                                       <tr><td>Subtotal </td><td  colspan=4 class="text-right"><span><?php echo($total .' EGP') ?></span></td></tr>
                                       <tr><td>Tax value </td><td  colspan=4 class="text-right"><span><?php $tax = $total * .14;echo($tax); ?></span></td></tr>
                                       <tr><td>Shipping </td><td  colspan=4 class="text-right"><span>20 EGP</span></td></tr>
                                       <tr class="text-danger"><td>Total </td><td  colspan=4 class="text-right"><span><?php $finalTotal = $total + 20 + $tax; echo(round($finalTotal,2).' EGP') ?></span></td></tr>

                                   </ul>
                                </table>
                            </div>
                            <div class="payment-method">
                                <div class="payment-accordion">
                                    <div id="accordion">
                                        <div class="card">

                                            </div>
                                            <?php
                                            include_once "payment.php";
                                            $pay = new payment();
                                            $res = $pay->getAll();
                                            $x = 1;
                                            while($row = mysqli_fetch_assoc($res)){
                                                ?>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="customRadio<?php echo($x)?>" name="payrad" class="custom-control-input" value="<?php echo($row['payment_id']) ?>" required>
                                                    <label class="custom-control-label" for="customRadio<?php echo($x)?>"><?php echo($row['type']) ?></label>
                                                 </div>
                                                <?php
                                                $x++;
                                            }
                                            ?>

                                            <!-- <div class="custom-control custom-radio">
                                                <input type="radio" id="customRadio2" name="payrad" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadio2">CASH</label>
                                            </div> -->
                                    <div class="order-button-payment">
                                        <input type="submit"  name="sub">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php

                    ?>
                    </form>
                </div>
                </div>
                </div>


        </div>
        <?php include "footer.php"; ?>
