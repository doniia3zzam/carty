<?php
ob_start();
session_start();
if(isset($_SESSION['username'])){
include "headerafter.php"; ?>
    
        <div class="profiletable">
            <form method="POST">
                <div class="text-right py-3">
                    
                </div>
                <br>
                <br>
                <div class="row">

                    <?php
              

                            // if(isset($_POST['gocheck'])){
                            //     include_once "address.php";
                            //     $addrs=new address();
                            //     $addrs->setId($_SESSION['userid']);
                            //     $addrs->updateAllPrimary();
                            //     $addrs->setaddressId($_POST['address']);
                            //     $addrs->setstatus('primary');
                            //     $addrs->updateaddressstatus();
                            //     header('location:checkout.php');


                            // }
                            
                            
                            if(isset($_POST['yes'])){
                               include_once "address.php";
                               $addrs=new address();
                               $addrs->setaddressId($_POST['yes']); 
                               $addrs->delete();
                            //   echo($_POST['yes']);
                           }
                    
                          
                           

                            if(isset($_POST['save'])){
                                include_once "address.php";
                                $addrs=new address();
                                $addrs->setId($_SESSION['userid']);
                                $addrs->updateAllPrimary();
                                $addrs->setaddressId($_POST['address']);
                                $addrs->setstatus('primary');
                                $addrs->updateaddressstatus();
                                if(isset($_GET['check'])){
                                    if($_GET['check'] == 1){
                                        header('Refresh:2; url=checkout.php');
                                    }
                                }

                            }
                   
                                // echo($_SESSION['userid']);
                                include_once "address.php";
                                $cust = new address();
                                $cust->setId($_SESSION['userid']);
                                $result = $cust->getProfile();
                                while ($row = mysqli_fetch_assoc($result)) {
                                    // echo("hello");

                    ?>
                      

                    <div class="col-12  col-md-3 ml-5">
                        <div class="card border-secondary my-3">
                            <div class="card-header ">
                                <div class="custom-control custom-radio my-2 ">
                                    <input type="radio" class="custom-control-input" id="customControlValidation3<?php echo($row['addressId']) ?>" name="address"  value="<?php echo($row['addressId']) ?>" <?php if($row['addressStatus']=='primary') echo('checked')?>  required>
                                    <label class="custom-control-label" for="customControlValidation3<?php echo($row['addressId']) ?>"> Address for shipping</label>
                                    <!-- <div class="invalid-feedback">More example invalid feedback text</div> -->
                                </div>
                                <!-- <input type="radio" required name="address" value="<?php //echo($row['addressId']) ?>" <?php //if($row['addressStatus']=='primary') echo('checked')?> /> -->
                                 
                            </div>
                            <div class="card-body text-secondary ">
                            <h5 class="card-title"><?php echo($_SESSION['username']) ?></h5>
                            <p class="card-text">
                                <b>PHONE: </b><?php echo($row['phone']) ?>
                                <br/>
                                 <b>Email: </b><?php echo($row['email']) ?>
                                <br/>
                                <?php if($row['lat'] == ""){ ?>
                                <b>Address: </b><?php echo($row['city']) ?> , <?php echo($row['area']) ?> ,
                                <?php echo($row['customerAddress']) ?>
                                
                                    <?php }else{
                                        ?>
                                    <b> Location: </b> Set By Google Maps
                                        <?php
                                    } ?>

                                    <br/><br>
                                    <?php if($row['lat'] == ""){ ?>
                                        <a href="editaccount.php?adsid=<?php echo($row['addressId']) ?>"  class="btn btn-outline-warning form-control">Edit address</a> 
                                    <?php } ?>
                                  
                                <button type="button" class="btn btn-outline-danger form-control" data-toggle="modal" name="delete" data-target="#exampleModalScrollable<?php echo($row['addressId']) ?>">Delete Address</button>
                            </p>
                        </div>
                    </div>
                  
                </div>
               
                <!-- Button trigger modal -->

                <!-- Modal -->
                <div class="modal fade" id="exampleModalScrollable<?php echo($row['addressId']) ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle<?php echo($row['addressId']) ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalScrollableTitle"><b>DELETE ADDRESS</b></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <h6 class=" text-center"><?php echo($_SESSION['username']); ?>, Are you sure delete your address ?</h6>
                            </div>
                            <div class="modal-footer">
                                <!-- <form method = 'post'> -->
                                    <input type="hidden" value="<?php echo($row['addressId']) ?>" name="addressId">
                                    <!-- <a href="myaccount.php?del=<?php //echo($row['addressId']) ?>"  class="btn btn-danger back" >Yes, Sure</a> -->
                                    <!-- <input type="submit" class="btn btn-danger back" value="Yes, Sure" name="yes"/> -->
                                    <button type="submit" class="btn  btn-danger back" name="yes" value="<?php echo($row['addressId']) ?>">Yes, Sure</button> 
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                <!-- </form> -->
                                
                            </div>
                        </div>
                    </div>
                </div>
                            <?php
                            }
                            ?>

                <!-- <label > <a href="updatepasswordafter.php" class="lead"> <b> Change password  <i class="fas fa-key"></i>  </b></a> </label> -->

                

              
                </div>

                <div class=" text-center my-3">
                    <input type="submit" class="btn btn-outline-warning " name="save" />
                    <a href="addaddress.php" class=" btn btn-outline-dark">Add New Address </a>
                    <!-- <input type="submit" class=" col-4 btn btn-warning form-control " name="gocheck" value="go to check out">  -->

                </div>
        </form>
    </div>

    <?php 

}else{
    header("location:index.php");
}
include "footer.php"; ?>