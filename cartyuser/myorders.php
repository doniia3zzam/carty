

<?php
ob_start();
session_start();
if(isset($_SESSION['username'])){
    include "headerafter.php";

    ?>
<div class="container-fluid">
    <div class="row my-5">
        <?php
            include_once "order.php";
            $or = new order();
            if(isset($_POST['cancel']))
            {
                $or->setOrderId($_POST['cancel']);
                $or->delete();
            }
            $or->setcustomerId($_SESSION['userid']);
            $res = $or->myOrders();
            while($row = mysqli_fetch_assoc($res)){
            //set it to writable location, a place for temp generated PNG files
            $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;                                            
            //html PNG location prefix
            $PNG_WEB_DIR = 'temp/';
            include_once "phpqrcode/qrlib.php";    
            //ofcourse we need rights to create temp dir
            if (!file_exists($PNG_TEMP_DIR))
                mkdir($PNG_TEMP_DIR);
            
            $filename = $PNG_TEMP_DIR.'test.png';
            //processing form input
            //remember to sanitize user input in real-life solution !!!
            $errorCorrectionLevel = 'L';
            $matrixPointSize = 4;
            
                // user data
                $filename = $PNG_TEMP_DIR.'test'.md5($row['order_id'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
                QRcode::png($row['order_id'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
            
            //display generated file
        ?>

       <div class="card col-12 col-md-5 m-5 hvr-glow">
            <?php if($row['status']==1){ ?>
            <button type="button" class="close cancelOr" aria-label="Close" data-toggle="modal" data-target="#exampleModal<?php echo($row['order_id']) ?>">
                <span aria-hidden="true">&times;</span>
            </button>
            <?php } ?>
            
            <div class="row d-flex justify-content-between px-3 top">
                <div class="d-flex" style="flex-direction: column;">
                    <!-- <h6>ORDER <span class="text-warning font-weight-bold">#<?php //echo($row['order_id']) ?></span></h6> -->
                    <h6 >No Of Products <span class="text-warning font-weight-bold">(<?php echo($row['countPro']) ?>)</span></h6>
                    <h6 >Total <span class="text-warning font-weight-bold"><?php echo($row['total']) ?></span></h6>
                    <p class="mb-0 "><b>Order Date : </b><span><?php  $date = date('d-m-Y', strtotime($row['date'])); echo($date) ?></span></p>
                    <p class="mb-0 "><b>Expected Arrival : </b><span><?php  echo date('d-m-Y', strtotime($date. ' + 5 days')); ?></span></p>
                    
                </div>
                <br>
                <div class="d-flex flex-column text-sm-left">
                <?php echo '<img  src="'.$PNG_WEB_DIR.basename($filename).'" />';  ?>
                </div>
            </div> <!-- Add class 'active' to progress -->
            <div class="row d-flex justify-content-center">
                <div class="col-12">
                    <ul id="progressbar" class="text-center">
                        <?php
                            for ($i=0; $i < $row['status']; $i++) { 
                                ?>
                                <li class="active step0"></li>
                                <?php
                            }
                            for ($i=0; $i <4-$row['status'] ; $i++) { 
                                ?>
                                <li class=" step0"></li>
                                <?php
                            }
                        ?>

                       
                    </ul>
                </div>
            </div>
            <div class="row justify-content-between top">
                <div class="row d-flex icon-content"> <img class="icon" src="https://i.imgur.com/9nnc9Et.png">
                    <div class="d-flex flex-column">
                        <p class="font-weight-bold">Order<br>Processed</p>
                    </div>
                </div>
                <div class="row d-flex icon-content"> <img class="icon" src="https://i.imgur.com/u1AzR7w.png">
                    <div class="d-flex flex-column">
                        <p class="font-weight-bold">Order<br>Shipped</p>
                    </div>
                </div>
                <div class="row d-flex icon-content"> <img class="icon" src="https://i.imgur.com/TkPm63y.png">
                    <div class="d-flex flex-column">
                        <p class="font-weight-bold">Order<br>En Route</p>
                    </div>
                </div>
                <div class="row d-flex icon-content"> <img class="icon" src="https://i.imgur.com/HdsziHP.png">
                    <div class="d-flex flex-column">
                        <p class="font-weight-bold">Order<br>Arrived</p>
                    </div>
                </div>
            </div>
            <a class="btn btn-outline-warning col-m" href="orderdetails.php?or=<?php echo($row['order_id']) ?>">Check you Order</a>
             <!-- Button trigger modal -->
             <!-- <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal<?php echo($row['order_id']) ?>">
            <?php //echo($row['order_id']) ?>
            </button> -->

            
        </div>


          <!-- Modal -->
          <div class="modal fade" id="exampleModal<?php echo($row['order_id']) ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel<?php echo($row['order_id']) ?>" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel<?php echo($row['order_id']) ?>"><b>CANCEL ORDER #<?php echo($row['order_id']) ?></b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6 class=" text-center"><?php echo($_SESSION['username']); ?>, Are you sure Cancel your Order ?</h6>
                </div>
                <form method="POST">
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" name="cancel" value="<?php echo($row['order_id']) ?>">Yes, Sure</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        
                    </div>
                </form>
                </div>
            </div>
            </div> 


<?php

    }
    ?>
    </div>
</div>
    <style>


.card {
    z-index: 0;
    background-color: #ECEFF1;
    padding-bottom: 20px;
    margin-top: 90px;
    margin-bottom: 90px;
    border-radius: 10px
}

.top {
    padding-top: 40px;
    padding-left: 13% !important;
    padding-right: 13% !important
}

#progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    color: #455A64;
    padding-left: 0px;
    margin-top: 30px
}

#progressbar li {
    list-style-type: none;
    font-size: 13px;
    width: 25%;
    float: left;
    position: relative;
    font-weight: 400
}

#progressbar .step0:before {
    font-family: FontAwesome;
    content: "\f10c";
    color: #fff
}

#progressbar li:before {
    width: 40px;
    height: 40px;
    line-height: 45px;
    display: block;
    font-size: 20px;
    background: #C5CAE9;
    border-radius: 50%;
    margin: auto;
    padding: 0px
}

#progressbar li:after {
    content: '';
    width: 100%;
    height: 12px;
    background: #C5CAE9;
    position: absolute;
    left: 0;
    top: 16px;
    z-index: -1
}

#progressbar li:last-child:after {
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
    position: absolute;
    left: -50%
}

#progressbar li:nth-child(2):after,
#progressbar li:nth-child(3):after {
    left: -50%
}

#progressbar li:first-child:after {
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
    position: absolute;
    left: 50%
}

#progressbar li:last-child:after {
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px
}

#progressbar li:first-child:after {
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px
}

#progressbar li.active:before,
#progressbar li.active:after {
    background: #27ae60
}

#progressbar li.active:before {
    font-family: FontAwesome;
    content: "\f00c"
}

.icon {
    width: 30px;
    height: 30px;
    margin-right: 15px
}

.icon-content {
    padding-bottom: 20px
}

@media screen and (max-width: 992px) {
    .icon-content {
        width: 50%
    }
}
</style>

    <?php
}else{
    header("location:index.php");
}
include "footer.php"; ?>
