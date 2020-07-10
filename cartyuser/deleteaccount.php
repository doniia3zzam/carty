<?php
ob_start();
session_start();
if(isset($_SESSION['username'])){
include "headerafter.php"; ?>
                <div class="container">
                    <div class="deletecard">
                        <br>
                        <h4 class="text-danger text-center"><?php echo($_SESSION['username']); ?>, are </h4>
                        <br>
                        <?php
                            if (isset($_POST['accDelete'])) {
                                if($_POST['deletePass']==''){
                                    echo('<div class="alert alert-danger text-center" role="alert">Please Enter your password</div>');
                                
                                   
                            }else{
                                include_once "customer.php";
                                $cust1 = new customer();
                                $cust1->setPassword(sha1($_POST['deletePass']));
                                $cust1->setId($_SESSION['userid']);
                                $log = $cust1->checkPass();
                                if ($row = mysqli_fetch_assoc($log)) {
                                    $msg = $cust1->delete();
                                    if($msg == 'ok'){

                                        echo('<div class="alert alert-success text-center" role="alert">YOUR ACCOUNT HAS BEEN DELETED</div>');
                                        header("Refresh:10; url=logout.php");
                                    }else{
                                        echo($msg);
                                    }
                                }
                                else{
                                    echo('<div class="alert alert-danger text-center" role="alert">wrong password</div>');
                                }
                            }
                        }
                        ?>
                        
                            <div>
                                <form method="post">
                                    <input type="password" placeholder="password" name="deletePass" class="form-control deletepass">
                                    <br>
                                    <div class="form-group text-center">
                                        <input type="submit" value="Delete " name="accDelete" class="btn btn-outline-danger "> 
                                        <a href="myaccount.php" class="btn btn-outline-warning back">Back</a> 
                                    </div>
                                    <br>
                                </form>
                            </div>
                    </div>
                </div>
<?php   
}else{
header("location:index.php");
}
include "footer.php"; ?>