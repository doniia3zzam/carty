<?php
ob_start();
session_start();
if(isset($_SESSION['username'])){
include "headerafter.php"; ?>
<div class = "container">
    <br><br>
    <h4 class="text-center h1reg">Update your Password</h4>
    <?php


    if(isset($_POST['actsub2'])){

        include "customer.php";
        $cust = new customer();
        $cust->setId($_SESSION['userid']);
        $cust->setPassword(sha1($_POST['actoldpass']));
        $result = $cust->checkpass();

        if($row = mysqli_fetch_assoc($result)){

                if ($_POST['actnewpass'] === $_POST['actrenewpass']) {
                    //    echo("MATCHED");
                    $reg="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/"; //Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character
                    if(preg_match($reg,$_POST['actnewpass'])){



                            $cust->setPassword(sha1($_POST['actnewpass']));
                            $result = $cust->update();
                            // echo($log);
                            if($result==="ok"){
                                echo('<div class="alert alert-success text-center" role="alert">Password has been updated</div>');
                                // header('Refresh:5; url:login.php');
                                header("Refresh:5; url=myaccount.php");

                            }
                            else{
                                echo('<div class="alert alert-danger text-center" role="alert">WRONG PASSWORD</div>');
                                echo($row);
                            }


                    }
                    else{
                        echo('<div class="alert alert-danger text-center" role="alert">PASSWORD IS WEAK</div>');
                    }
                }
                else{
                    echo('<div class="alert alert-danger text-center" role="alert">PASSWORD NOT MATCHED</div>');

                }

        }else{
            echo('<div class="alert alert-danger text-center" role="alert">Your old password is Wrong </div>');
        }

    }
    ?>
    <br>
    <div style="width: 60%" class="m-auto">
        <form method="POST">
                <div class="form-group">
                    <input id="email_modal" type="password" placeholder="Old password " class="form-control" name="actoldpass">
                </div>
                <div class="form-group">
                    <input id="password_modal" type="password" placeholder="New password" class="form-control" name="actnewpass">
                </div>
                <div class="form-group">
                    <input id="password_modal" type="password" placeholder="Retype New password" class="form-control" name="actrenewpass">
                </div>
                <p class="text-center">
                    <button type="submit" class="btn btn-outline-success" name="actsub2">Update password</button>
                </p>

        </form>
    </div>
    <br><br><br>
</div>
<?php
}else{
    header("location:index.php");
}
include "footer.php"; ?>
