

<?php
ob_start();
session_start();
if(isset($_SESSION['username'])){
    include "headerafter.php";
    ?>

     <!-- Begin Uren's Breadcrumb Area -->
        <div class="breadcrumb-area">
            <div class="container">
                <div class="breadcrumb-content">
                    <h2>Other</h2>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li class="active">Cart</li>
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
                        <div class="table-content table-responsive">
                            <form method="post">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th> Item </th>
                                            <th class="uren-product-thumbnail">image</th>
                                            <th class="cart-product-price">Product</th>
                                            <th class="uren-product-name">Unit Price</th>
                                            <th class="uren-product-quantity">Quantity</th>
                                            <th class="uren-product-subtotal">Total</th>
                                            <th class="cart-product-price">Comment</th>
                                            <th class="cart-product-price">Rate</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                    include_once "order.php";
                                    $or = new order();
                                    $or->setOrderId($_GET['or']);
                                    $res = $or->myOrderProducts();
                                    $x=1;
                                    $flag = 0;
                                    while($row = mysqli_fetch_assoc($res)){

                                        ?>

                                                <tr class = "rem">
                                                    <td><?php echo($row['product_id'])?></td>
                                                    <td class="uren-product-thumbnail">
                                                    <?php
                                                        include_once "products.php";
                                                        $single = new products();
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
                                                    <td class="uren-product-name"><a href="single-product-sale.php?pro=<?php echo($row['product_id']) ?>&supp=<?php echo($row['supplier_id']) ?>"><?php $price= $row['name'] ;echo($price); ?></a></td>
                                                    <td class="uren-product-price"><span class="amount"><?php echo($row['price'].' EGP') ?></span></td>
                                                    <td class="quantity"><?php $quantity = $row['quantity'];  echo($quantity); ?></td>
                                                    <td class="product-subtotal"><span class="amount"><?php $sub =  $row['quantity'] * $row['price']; $total+=$sub; echo($sub.' EGP');?></span></td>
                                                    <td><input type="text" class="form-control" placeholder="Comment" name="txtcomment<?php echo($x) ?>" <?php if($row['status'] != 4) echo('disabled') ?>></td>
                                                    <td>
                                                        <div class="star-rating ">
                                                            <input id="star-5<?php echo($x) ?>" type="radio" name="rating<?php echo($x) ?>" value="5" <?php if($row['status'] != 4) echo('disabled') ?>/>
                                                            <label for="star-5<?php echo($x) ?>" title="5 stars">★</label>
                                                            <!-- &nbsp; -->
                                                            <input id="star-4<?php echo($x) ?>" type="radio" name="rating<?php echo($x) ?>" value="4" <?php if($row['status'] != 4) echo('disabled') ?>/>
                                                            <label for="star-4<?php echo($x) ?>" title="4 stars">★</label>
                                                            <!-- &nbsp; -->
                                                            <input id="star-3<?php echo($x) ?>" type="radio" name="rating<?php echo($x) ?>" value="3" <?php if($row['status'] != 4) echo('disabled') ?>/>
                                                            <label for="star-3<?php echo($x) ?>" title="3 stars">★</label>
                                                            <!-- &nbsp; -->
                                                            <input id="star-2<?php echo($x) ?>" type="radio" name="rating<?php echo($x) ?>" value="2" <?php if($row['status'] != 4) echo('disabled') ?>/>
                                                            <label for="star-2<?php echo($x) ?>" title="2 stars">★</label>
                                                            <!-- &nbsp; -->
                                                            <input id="star-1<?php echo($x) ?>" type="radio" name="rating<?php echo($x) ?>" value="1" <?php if($row['status'] != 4) echo('disabled') ?> />
                                                            <label for="star-1<?php echo($x) ?>" title="1 star">★</label>
                                                        </div>

                                                    </td>
                                                </tr>
                                                <?php
                                                 if($row['status'] == 4) {
                                                     $flag = 1;
                                                 }
                                                if(isset($_POST['btnrate']))
                                                {
                                                        $or->setcomment($_POST['txtcomment'.$x]);

                                                        if(isset($_POST['rating'.$x])){
                                                            $or->setrateValue($_POST['rating'.$x]);
                                                        }
                                                        else{
                                                            $or->setrateValue(0);
                                                        }
                                                        $msg=$or->setRate();
                                                        $mr=$or->getLastId();

                                                        $or->setLastRateId($mr);
                                                        $or->setOrderId($_GET['or']);
                                                        $or->setProId($row['product_id']);
                                                        $or->setSuppId($row['supplier_id']);
                                                        $result2 = $or->setOrderedRate();
                                                        if ($result2 == 'ok') {
                                                            ?>
                                                            <?php if($x == 1) {?>
                                                            <div class="alet alert-success text-center py-4">You have Successfully Rated This Products</div>
                                                            <?php } ?>
                                                            <?php
                                                        }else{
                                                            echo($result2);
                                                        }
                                                }

                                                $x++;
                                            }
                                                ?>
                                    </tbody>
                                </table>
                                <?php
                                if($flag){
                                    ?>

                                <div class="text-right my-2">
                                <input type="submit" class="btn btn-warning" value="Submit Rating" name="btnrate">
                                </div>
                                <?php
                                } ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
}else
    {
        header("location:index.php");
    }
include "footer.php"; ?>
