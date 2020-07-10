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
                    <h2>Other</h2>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li class="active">wishlist</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Uren's Breadcrumb Area End Here -->
        <!-- Begin Uren's Cart Area -->
        <div class="uren-cart-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <form method="POST">
                            <div class="table-content table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th> Item </th>
                                            <th class="uren-product-thumbnail">image</th>
                                            <th class="cart-product-name">Product</th>
                                            <th class="uren-product-price">Unit Price</th>
                                            <th class="uren-product-stock-status">Stock Status</th>
                                            <th class="uren-product-remove">remove</th>
                                            <th class="uren-cart_btn">add to cart</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                         if(isset($_SESSION['username'])){
                                              /* add to wishlist from index hadeer */ 
                                              include_once "products.php";
                                              $single = new products();
                                              if (isset($_GET['pro']) && isset($_GET['supp']) ) {
                                              $single->setProId($_GET['pro']);
                                              $single->setSuppId($_GET['supp']);
                                              $result = $single->getSingleProduct();
                                              // echo($result);
                                                  if($rows= mysqli_fetch_assoc($result)) {
                                                          
                                              
                                                    include_once "temp_wishlist.php";
                                                    $wishlist = new temp_wishlist(); 
                                                    $wishlist->setProId($_GET['pro']);
                                                    $wishlist->setSuppId($_GET['supp']);
                                                    $wishlist->setUserId($_SESSION['userid']);
                                                    $wishlist->setQuantity(1);
                                                    $wishlist->setProName($rows['name']);
                                                    $wishlist->setPrice($rows['price']);
                                                    $response = $wishlist->add();

                                                    if($response != 'ok'){
                                                        $response1 = $wishlist->update();
                                                    }
                                                          
                                                  }
                                              }
                                              /* end add to wishlist from index hadeer */ 
                                            
                                        include_once "temp_wishlist.php";
                                        $wishlist = new temp_wishlist();
                                        if(isset($_COOKIE["wishlist"])){

                                            $cookie_data = stripcslashes($_COOKIE['wishlist']);
                                            $wish_data=json_decode($cookie_data,true);
                                            foreach($wish_data as $keys => $values)
                                            {
                                                $wishlist->setProId($values['product_id']);
                                                $wishlist->setSuppId($values['supplier_id']);
                                                $wishlist->setUserId($_SESSION['userid']);
                                                $wishlist->setProName($values['product_name']);
                                                $wishlist->setQuantity(1);
                                                $wishlist->setPrice($values['price']);
                                                $resa = $wishlist->add(); 
                                                if($resa != 'ok'){
                                                    $resa = $wishlist->update();
                                                }
                                            }
                                            $cookie_nam = "wishlist";
                                            unset($_COOKIE[$cookie_nam]);
                                            // empty value and expiration one hour before
                                            $res = setcookie($cookie_nam, '', time() - 3600);

                                        }
                                            $wishlist->setUserId($_SESSION['userid']);
                                            $res = $wishlist->getAll();
                                            $x= 1;
                                            $total = 0; 
                                            while($row = mysqli_fetch_assoc($res)){
                                        ?>
                                        <tr class = "rem<?php echo($x)?>">
                                            <td><?php echo($x)?></td>
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
                                            <img src="assets/images/product/small-size/<?php echo($rowi['image_name']) ?>" alt="Uren's Cart Thumbnail" style="width: 100px; height:100px">
                                            <?php
                                                    }
                                                ?>
                                                </a>
                                                <?php
                                                }?>
                                        </td>
                                            <td class="uren-product-name"><a href="single-product-sale.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id']) ?>"><?php $price= $row['product_name'] ;echo($price); ?></a></td>
                                            <td class="uren-product-price"><span class="amount"><?php echo($row['price'].' EGP') ?></span></td>
                                            <td class="uren-product-stock-status"><span class="in-stock"><?php if($row['stock_quantity']>0 && $row['stock_quantity'] >= $row['quantity'] ){echo('in-stock'); }else {echo ('out-of-stock');} ?></span></td>
                                            <td class="uren-product-remove"><a href="javascript:void(0)"><input style="display:none;" type="submit" name="submit<?php echo($x)?>" class="submit<?php echo($x)?>" id=""><i class="fa fa-trash close<?php echo($x)?>"
                                                title="Remove"></i></a></td>
                                           <td class="uren-cart_btn"><input <?php if($row['stock_quantity']>0 && $row['stock_quantity'] >= $row['quantity'] ){echo(''); }else {echo ('disabled');} ?> type="submit" name="addToCart<?php echo($x)?>" class="addToCart" value="Add To Cart" style="margin:auto">
                                        </tr>
                                        <script>
                                            $(document).ready(function(c) {
                                            $('.close<?php echo($x)?>').on('click', function(c){
                                                $('.submit<?php echo($x)?>').click();
                                                $('.rem<?php echo($x)?>').fadeOut('slow', function(c){
                                                    $('.rem<?php echo($x)?>').remove();
                                                });
                                                });	  
                                            });
                                        </script>
                                        
                                        <?php
                                        
                                        if (isset($_POST['submit'.$x])) {

                                            $wishlist->setProId($row['product_id']);
                                            $wishlist->setSuppId($row['supplier_id']);
                                            $wishlist->setUserId($_SESSION['userid']);
                                            $msg = $wishlist->delete();
                                            header('location:wishlist.php');
                                            if($msg == "ok"){
                                                echo('done');
                                            }else{
                                                echo($msg);
                                            }
                                        }
                                        
                                        if (isset($_POST['addToCart'.$x]) ) {
                                            
                                            include_once "temp_cart.php";
                                            $cart = new temp_cart();
                                            $cart->setProId($row['product_id']);
                                            $cart->setSuppId($row['supplier_id']);
                                            $cart->setUserId($_SESSION['userid']);
                                            $cart->setQuantity('1');
                                            $cart->setProName($row['product_name']);
                                            $cart->setPrice($row['price']);
                                            $response = $cart->add();

                                            if($response != 'ok'){
                                                $response1 = $cart->update();
                                            }

                                            $wishlist->setProId($row['product_id']);
                                            $wishlist->setSuppId($row['supplier_id']);
                                            $wishlist->setUserId($_SESSION['userid']);
                                            $msg = $wishlist->delete();
                                            header('location:wishlist.php');
                                            if($msg == "ok"){
                                                echo('done');
                                            }else{
                                                echo($msg);
                                            }
                                        }
                               
                                        $x++;
                                        }
                                    }
                                    else
                                    { 
                                          /* add to cart from index hadeer */ 
                                          include_once "products.php";
                                          $single = new products();
                                          if (isset($_GET['pro']) && isset($_GET['supp']) ) {
                                          $single->setProId($_GET['pro']);
                                          $single->setSuppId($_GET['supp']);
                                          $result = $single->getSingleProduct();
                                          // echo($result);
                                              if($rows= mysqli_fetch_assoc($result)) {

                                                  if(isset($_COOKIE["wishlist"])){
                                                  $cookie_data = stripcslashes($_COOKIE['wishlist']);
                                                  $wish_data=json_decode($cookie_data,true);
                                              }else

                                              $wish_data=array();
      
                                              $item_id_list = array_column($wish_data, 'product_id');
                                              if(in_array($_GET['pro'], $item_id_list))
                                              {
                                                  foreach($wish_data as $keys => $values)
                                                  {
                                                       if($wish_data[$keys]["product_id"] == $_GET['pro'])
                                                  {

                                                      
                                              }
                                              }
                                              }
                                              else
                                              {
                                              $item_array = array(
                                                  'product_id' => $_GET['pro'],
                                                  'supplier_id' => $_GET['supp'],
                                                  'quantity' => 1,
                                                  'product_name' => $rows['name'],
                                                  'price' => $rows['price'],
                                                  'stock_quantity' => $rows['stock_quantity']
                                              );
                                              $wish_data[] = $item_array;
                                              }
                                          
                                              
                                              $item_data = json_encode($wish_data);
                                              setcookie('wishlist', $item_data, time() + (86400 * 30));
                                              header('location:wishlist.php');
                                          }  
                                          }}
                                                  /* end add to cart from index hadeer */ 
                                                  if(isset($_COOKIE["wishlist"]))
                                                  {
                                                        $cookie_data = stripcslashes($_COOKIE['wishlist']);
                                                        $wish_data=json_decode($cookie_data,true);
                                                        $x=1;
                                                        foreach($wish_data as $keys => $values)
                                                        {
                                                            ?>
                                                        
                                                        <tr class = "rem<?php echo($x)?>">
                                                        <td><?php echo($x)?></td>
                                                        <td class="uren-product-thumbnail"><a href="single-product-sale.php?pro=<?php echo($values['product_id']) ?>&supp=<?php echo($values['supplier_id']) ?>"><img src="assets/images/product/small-size/1.jpg" alt="Uren's Cart Thumbnail"></a></td>
                                                        <td class="uren-product-name"><a href="single-product-sale.php?pro=<?php echo($values['product_id']) ?>&supp=<?php echo($values['supplier_id']) ?>"><?php $price= $values['product_name'] ;echo($price); ?></a></td>
                                                        <td class="uren-product-price"><span class="amount"><?php echo($values['price'].' EGP') ?></span></td>
                                                        <td class="uren-product-stock-status"><span class="in-stock"><?php if($values['stock_quantity']>0)echo('in-stock'); else echo ('out-of-stock'); ?></span></td>
                                                        <td class="uren-product-remove"><a href="wishlist.php?action=delete&id=<?php echo $values["product_id"]; ?>"><input style="display:none;" type="submit" name="submit<?php echo($x)?>" class="submit<?php echo($x)?>" id=""><i class="fa fa-trash close<?php echo($x)?>"
                                                            title="Remove"></i></a></td>
                                                        <td class="uren-cart_btn"><a href="wishlist.php?act=addToCart&pro=<?php echo($values['product_id']) ?>&supp=<?php echo($values['supplier_id']) ?>">add to cart<input  type="submit" <?php if($values['stock_quantity']>0)echo(''); else echo ('disabled'); ?>  value="Add To Cart" style="margin:auto; display:none;"></a></td>
                                                        </tr>
                                                        
                                                    <?php
                                                    if(isset($_GET["action"]))
                                                    {
                                                    if($_GET["action"] == "delete")
                                                    {
                                                            $cookie_data = stripcslashes($_COOKIE['wishlist']);
                                                            $wish_data=json_decode($cookie_data,true);
                                                            foreach($wish_data as $keys => $values)
                                                            {
                                                                if($wish_data[$keys]['product_id'] == $_GET['id'])
                                                                {
                                                                unset($wish_data[$keys]);
                                                                $item_data = json_encode($wish_data);
                                                                setcookie("wishlist", $item_data, time() + (86400 * 30));
                                                                 header("location:wishlist.php?remove=1");
                                                                }
                                                            }
                                                        }}

                                                        if(isset($_GET["act"]))
                                                        {
                                                        if ($_GET["act"] == "addToCart"){
                                                            if(isset($_COOKIE["cart"]))
                                                            {
                                                                $cookie_data = stripcslashes($_COOKIE['cart']);
                                                                $cart_data=json_decode($cookie_data,true);
                                                            }
                                                            else
                                                                $cart_data=array();
                                                                $item_id_list = array_column($cart_data, 'product_id');
                                                            if(in_array($_GET['pro'], $item_id_list))
                                                            {
                                                            foreach($cart_data as $keys => $values)
                                                            {
                                                            if($cart_data[$keys]["product_id"] == $_GET['pro'])
                                                            {
                                                            $cart_data[$keys]["quantity"] = $cart_data[$keys]["quantity"] + 1;
                                                            }
                                                            }
                                                            }
                                                            else
                                                            {
                                                            $item_array = array(
                                                                'product_id' => $_GET['pro'],
                                                                'supplier_id' => $_GET['supp'],
                                                                'quantity' => 1,
                                                                'product_name' => $rows['name'],
                                                                'price' => $rows['price'],
                                                                
                                                            );
                                                            $cart_data[] = $item_array;
                                                            }
                                                            $item_data = json_encode($cart_data);
                                                            setcookie('cart', $item_data, time() + (86400 * 30));
                                                            $cookie_data = stripcslashes($_COOKIE['wishlist']);
                                                            $wish_data=json_decode($cookie_data,true);
                                                            foreach($wish_data as $keys => $values)
                                                            {
                                                                if($wish_data[$keys]['product_id'] == $_GET['pro'])
                                                                {
                                                                unset($wish_data[$keys]);
                                                                $item_data = json_encode($wish_data);
                                                                setcookie("wishlist", $item_data, time() + (86400 * 30));
                                                                
                                                                }
                                                            }
                                                            // header("location:wishlist.php?add=1");
                                                          
                                                        }  
    
                                                       
                                                        
                                                        $x++;
                                                        }
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
                                        <div class="coupon2">
                                            <input class="button" name="update_cart" value="Update cart" type="submit">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
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