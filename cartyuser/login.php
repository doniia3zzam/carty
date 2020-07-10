<?php ob_start(); session_start(); include "headerbefore.php"; ?>


    
<style>
  /* show and hide password */
  .field-icon {
  float: right;
  margin-right: 9px;
  margin-top: -40px;
  position: relative;
  z-index: 2;
}
</style>
 <!-- Begin Uren's Login Register Area -->
 <div class="uren-login-register_area">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 m-auto">
                <?php

                    if(isset($_COOKIE['userCookie'])){
                        header('location:index.php');
                    }
                    if(isset($_SESSION['username'])){
                        header('location:index.php');
                    }


                    if(isset($_POST['logsub'])){


                    include "customer.php";
                    $cust = new customer();
                    $cust->setEmail($_POST['logep']);
                    // $cust->setPhone($_POST['logep']);
                    $cust->setPassword(sha1($_POST['logpass']));
                    $log = $cust->login();
                    // echo($log);
                    if($row = mysqli_fetch_assoc($log)){
                        // echo('<div class="alert alert-success text-center" role="alert">CORRECT PASSWORD</div>');
                        if(isset($_POST['logchk'])){
                            setcookie("userCookie",$_POST['logep'],time()+60*60*24*365);
                            // echo("OK");
                        }
                        $_SESSION['username'] = $row['first_name'] . ' ' . $row['last_name'];
                        $_SESSION['userid'] = $row['customer_id'];
                        $_SESSION['photo'] = $row['photo_name'];
                        header('location:index.php');
                    }
                    else{
                        echo('<div class="alert alert-danger text-center" role="alert">WRONG USER OR PASSWORD</div>');
                        echo($row);
                    }
                    }
                    include_once "temp_cart.php";
                    $cart = new temp_cart();
                    if(isset($_SESSION['userid'])){
                    if(isset($_COOKIE["cart"])){

                    $cookie_data = stripcslashes($_COOKIE['cart']);
                    $cart_data=json_decode($cookie_data,true);
                    foreach($cart_data as $keys => $values)
                    {
                        $cart->setProId($values['product_id']);
                        $cart->setSuppId($values['supplier_id']);
                        $cart->setUserId($_SESSION['userid']);
                        $cart->setProName($values['product_name']);
                        $cart->setQuantity($values['quantity']);
                        $cart->setPrice($values['price']);
                        $resa = $cart->add(); 
                        if($resa != 'ok'){
                            $resa = $cart->update();
                        }
                    }
                    $cookie_name = "cart";
                    unset($_COOKIE[$cookie_name]);
                    // empty value and expiration one hour before
                    $resal = setcookie($cookie_name, '', time() - 3600);        
                    }}
                ?>
                <!-- Login Form s-->
                <form method="POST">
                    <div class="login-form">
                        <h4 class="login-title">Login</h4>
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <!-- <label>Email Address*</label> -->
                                <input type="text" placeholder="Email or phone *" class="form-control" name="logep">
                            </div>
                            <div class="col-12 mb--20">
                                <!-- <label>Password</label> -->
                                <input type="password" placeholder="password *" class="form-control" name="logpass" id="txtpassword">
                                <span toggle="#txtpassword" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                            <div class="col-md-8">
                                <div class="check-box">
                                    <input type="checkbox" id="remember_me" name="logchk">
                                    <label for="remember_me">Remember me</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="forgotton-password_info">
                                    <a href="forgetpassword.php"> Forgotten pasward?</a>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="uren-login_btn" name="logsub"><i class="fa fa-sign-in"></i> Log in </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(".toggle-password").click(function() {

$(this).toggleClass("fa-eye fa-eye-slash");
var input = $($(this).attr("toggle"));
if (input.attr("type") == "password") {
    input.attr("type", "text");
} else {
    input.attr("type", "password");
}
});
</script>




<?php include "footer.php"; ?>