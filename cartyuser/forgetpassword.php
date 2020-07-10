<?php ob_start();
    include "headerbefore.php";
    require_once "src/PHPMailer.php";
    require_once "src/Exception.php";
    require_once "src/SMTP.php";
    require_once "vendor/autoload.php";
    session_start(); 
?>
<div class = "container">
<br><br><br>
    <h4 class="text-center h1reg">Find Your Account</h4>
    <?php

   
    if(isset($_POST['actsub'])){

   
    include "customer.php";
    $cust = new customer();
    $cust->setEmail($_POST['actep']);
    
    $chk = $cust->checkEmail();
    // echo($log);
    $activation;
    if($row = mysqli_fetch_assoc($chk)){
        
        // echo("ok");
        $activation = rand(11111,99999);
        $link = 'http://localhost:803/phpnti/ecommerce%20project/final%20test/updatepassword.php?usid='.$row['customer_id'].'';
        // echo($link);

        // mail code 
        
        //ecommercenti@gmail.com ggggg55555                     Test@123465

        $mail = new  PHPMailer\PHPMailer\PHPMailer();
        $mail->IsSMTP();
        //$mail->SMTPDebug = 1;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465; // or 587
        $mail->IsHTML(true);

        $mail->Username = "yourmobileapp2017@gmail.com";
        $mail->Password = "ABC@123456bb";

        $mail->setFrom('yourmobileapp2017@gmail.com', 'NTI');
        $mail->addAddress($_POST['actep'], "nn");
    
        
        $mail->Subject = 'Forget Password ECommerce NTI';
        $mail->Body = "Dear , Your Activation Code is <b> ".$activation ." </b> please  visit this link ".$link;
        
        if(!$mail->send()) {
            echo "<br><b>Opps! For some technical reasons we couldn't able to sent you an email. We will shortly get back to you with download details.";	
            echo "Mailer Error: " . $mail->ErrorInfo .'</b><br>';
        } else {
            $_SESSION['activationcode']=$activation;
            echo("<h4 class='alert alert-success text-center'>Message has been sent , check your email </h4>");
            header('Refresh:5; url:login.php');
        }
    }
    else{
        echo('<div class="alert alert-danger text-center" role="alert">This Email not Exist</div>');
        echo($row);
    }
}
    ?>
    
    <div style="width: 60%;" class="m-auto">
        <form method="POST">
                <div class="form-group">
                    <label for="email_modal">Please enter your email address to search for your account.</label>
                    <input id="email_modal" type="email" placeholder="Email address" class="form-control" name="actep">
                </div>
                
                
                <p class="text-center">
                    <button type="submit" class="btn btn-warning" name="actsub"> <b>   Send activation code  </b> </button>
                </p>
                
        </form>
    </div>
</div>
<br><br><br>
<?php include "footer.php"; ?>