<?php
ob_start();
session_start();
if(isset($_SESSION['username'])){
    include "headerafter.php";
}else{
    include "headerbefore.php";
    header('location:login.php');
    } ?>
 <div class="row offset-3 my-5">
                    <div class="col-lg-8 col-12">
                        <div class="your-order">
                        <form method="post">
                            <h3>ship to your adress</h3>
                            <div>
                                <table class="table">
                                <?php
                                    include_once "order.php";
                                    $or = new order();
                                   
                                    $or->setOrderId($_GET['id']);
                                    $res = $or->showOrder();
                                    if($row = mysqli_fetch_assoc($res)){
                                        
                                        ?>
                                        <tr class="cart_item">
                                            <th class="cart-product-name">Order Number </th>
                                            <td class="cart-product-total"><?php echo($_GET['id']) ?></td>
                                        </tr>
                                    
                                        <tr>
                                            <th class="cart-product-name">username</th>
                                            <td class="cart-product-total"><?php echo($_SESSION['username']) ?></td>
                                        </tr>
                                   
                                        <tr class="cart_item">
                                            <th class="cart-product-name">Phone </th>
                                            <td class="cart-product-total"><?php echo($row['phone']) ?></td>
                                        </tr>
                                        
                                        <tr class="cart_item">
                                            <th class="cart-product-name">Adress </th>
                                            <td class="cart-product-total"><?php echo($row['area']) ?>-<?php echo($row['customerAddress']) ?></td>
                                        </tr>
                                        <tr class="cart_item">
                                            <th class="cart-product-name">QRCODE </th>
                                            <td class="cart-product-total">
                                        <?php    
    
    //set it to writable location, a place for temp generated PNG files
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
    
    //html PNG location prefix
    $PNG_WEB_DIR = 'temp/';

    include "phpqrcode/qrlib.php";    
    
    //ofcourse we need rights to create temp dir
    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);
    
    $filename = $PNG_TEMP_DIR.'test.png';
    
    //processing form input
    //remember to sanitize user input in real-life solution !!!
    $errorCorrectionLevel = 'L';
      

    $matrixPointSize = 4;
      
        // user data
        $filename = $PNG_TEMP_DIR.'test'.md5($_GET['id'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        QRcode::png($_GET['id'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
       
    //display generated file
    echo '<img  src="'.$PNG_WEB_DIR.basename($filename).'" /><hr/>';  
    
    ?>
                              </td>
                                        </tr>          

                                   <?php 
                                   }
                                   ?>
                                  
                                </table>
                            </div>
                            
                                    <div class="bg-dark form-control text-center">
                                        
                                    <a href="myorders.php">go to orders</a>
                                       
                                    </div>
                        </div>
                    </div>
                        
                   
                  
                    </form>
                </div>
                <?php include "footer.php"; ?>