<?php
ob_start();
session_start();
if(isset($_SESSION['username'])){
    include "headerafter.php";

}else{
    include "headerbefore.php";
    } ?>
    <div class="card">
        <div class="card-header"><h3><?php echo $_SESSION['username'];?> Address Book </h3></div>
        <div class="card-body">
            <div class="card">
                <?php
                    include_once "address.php";
                        $cart = new address();
                        $cart->setId($_SESSION['userid']);
                        $res = $cart->getAll();
                        while($row = mysqli_fetch_assoc($res)){
                                                
                ?>
            </div>
        </div>
        <div class="card-footer">
           <div class="bg-dark form-control text-center">
               <a href="<?php echo 'addaddress.php'?>">choose address</a>
                                      
           </div>
        </div>
    </div>                               


<?php include "footer.php" ?>