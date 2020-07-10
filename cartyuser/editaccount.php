<?php
ob_start();
session_start();
if(isset($_SESSION['username'])){
include "headerafter.php"; ?>
    <style>

    </style>
    <div class="container  ">
        <div class="profiletable  ">

            <?php

            include_once "address.php";

            $cust = new address();
            $cust->setaddressId($_GET['adsid']);
            $result = $cust->getAddress();

            if ($row = mysqli_fetch_assoc($result)) {
                // echo("hello");

                ?>
                <br>
                <br>
                <form method="post" enctype="multipart/form-data">

                    <div class="card ">

                        <?php 

                            if (isset($_POST['editUpdate'])) {
                                // include_once "customer.php";

                                // $cust1 = new customer();
                                // $cust1->setId($_SESSION['userid']);
                                // $cust1->setphone($_POST['editPhone']);
                                // $cust1->updateProfile();

                                include_once "address.php";
                                $adds = new address();
                                $adds->setId($_POST['txtaddressid']);
                                $adds->setCity($_POST['txtcity']);
                                $adds->setarea($_POST['txtarea']);
                                $adds->setphone($_POST['editPhone']);
                                $adds->setStreet($_POST['txtstreet']);
                                $adds->setbuildno($_POST['txtbuild']);
                                $adds->setfloorno($_POST['txtfloor']);
                                $adds->setaddstyp($_POST['txtaddresstyp']);
                                $adds->update();
                                // header('Refresh:3; url=myaccount.php');
                                header('location:myaccount.php');
                            }
                                // $file = $_FILES['file'];
                                // // print_r($file);
                                // $fileName = $_FILES['file']['name'];
                                // $fileExtention = explode('.',$fileName);
                                // $actualFileExtention = strtolower(end($fileExtention));   
                                // $allowedExt = array('jpg','png','jpeg');

                                // $fileSize = $_FILES['file']['size'];
                                // $fileTmpName = $_FILES['file']['tmp_name'];
                                // $fileError = $_FILES['file']['error'];
                                // $fileType = $_FILES['file']['type'];
                                // echo($filename);

                            //     if(in_array($actualFileExtention,$allowedExt)){
                            //         if($fileError === 0){
                            //            if($fileSize < 50000000) {
                            //                 $fileNameNew = $row['customer_id'].'.'.$actualFileExtention;
                            //                 // $_SESSION['photoname'] = $fileNameNew;
                            //                 $fileDest = 'assets/images/customer images/'.$fileNameNew;
                            //                 move_uploaded_file($fileTmpName,$fileDest);
                            //                 // echo('<img src="'.$fileDest.'" width=200 height=200 class="hello">');
                            //                 $cust1->setPhotoName($fileNameNew);
                            //                 $msg = $cust1->updateProfile();

                            //                 if($msg=="ok"){
                            //                     echo('<div class="alert alert-success text-center" role="alert">IFORMATIONS HAS BEEN UPDATED</div>');
                            //                     $_SESSION['username'] = $_POST['editFName'] . ' ' . $_POST['editLName'];
                            //                     $_SESSION['photo'] = $fileNameNew;
                            //                     header("Refresh:5; url=myaccount.php");
                            //                 }
                            //                 else
                            //                     echo('<div class="alert alert-danger text-center" role="alert">ERROR IS : '.$msg);

                            //             }else{
                            //                 echo("Too big!");
                            //             }
                            //         }else{
                            //             echo("ERROR try again");
                            //         }
                            //     }else{
                            //         echo("you cannt upload");
                            //     }

                           

                             ?>
                            <!-- <div class="row ">

                            <div class="profilephoto col">
                                <div id="" class="rounded-circle d-block m-auto profilephoto" style="background:url('customer images/<?php //echo($row['customer_id']) ?>.jpg') no-repeat; background-size:cover" ><div id="profilephotohover" class="rounded-circle"><button id="btnUpload">Change Photo <i class="fas fa-camera"></i></button></div></div>
                                <img width=200px height=200px class="rounded-circle d-block m-auto " id="img1" src="assets/images/customer images/<?php echo($row['photo_name']); ?>" alt="">
                                <div id="profilephotohover" class="rounded-circle">
                                <div id="btnUpload"><hr>Change Photo <i class="fas fa-camera"></i>
                                </div>
                                </div>
                                <input id="inputUpload" style="display:none;" type="file" name="file" onchange="showPhoto()" />
                            </div>
                            </div> -->
                          
                                <div class="row py-5">

                                    <div class="col">
                                        <h2 class="text-center"> <?php echo($_SESSION['username']); ?></h2>
                                    </div>
                                </div>
                                <div class="card-body offset-3">

                                    <div class="row">
                                        <div class="col-12 col-md-8">
                                            <b>Street</b>
                                            <input type="text" class="form-control " name="txtstreet" value="<?php echo($row['customerAddress']) ?>">

                                        </div>

                                    </div>
                                    

                                    <div class="row">
                                        <div class="col-12 col-md-4">
                                            <b>City</b>

                                            <!-- <?php echo($row['city_id']) ?> -->
                                            <select id="inputState" class="form-control" name="txtcity">
                                                <?php

                                        include_once "city.php";
                                        $city = new city();
                                        $result = $city->getAll();
                                        while($rows1 = mysqli_fetch_assoc($result)){

                                            ?>

                                                    <option  value='<?php echo($rows1['city_id'])?>' <?php if($rows1['city_id'] == $row['city_id']) echo('selected')?>>
                                                            <?php echo($rows1['name']);?>
                                                    </option>

                                                    <?php

                                        }

                                        ?>

                                            </select>
                                        </div>
                                        <div class="col-12 col-md-4">

                                            <b>area</b>
                                            <input type="text" class="form-control"  hidden name="txtaddressid" value="<?php echo($row['addressId']);?>">

                                            <input type="text" class="form-control" name="txtarea" value="<?php echo($row['area']);?>">
                                        </div>

                                    </div>
                                    <div class="row ">
                                        <div class="col-12 col-md-4">
                                            <b>Floor No</b>
                                            <input type="number" class="form-control" name="txtfloor" value="<?php echo($row['floorNo']);?>">
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <b>building no/name</b>
                                            <input type="text" class="form-control" name="txtbuild" value="<?php echo($row['buildingNo']);?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                   
                                        <div class="col-12 col-md-4">
                                            <b>Phone</b>
                                            <input type="tel" class="form-control" name="editPhone" value="<?php echo($row['phone']);?>">

                                        </div>
                                        <div class="col-12 col-md-4">
                                            <b>address type</b>
                                            <input type="text" class="form-control" name="txtaddresstyp" value="<?php echo($row['addressType']);?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-4 py-5">
                                        <input type="submit" style="line-height:100%;font-size: 1.25rem;" value="Update changes" name="editUpdate" class="btn btn-outline-success form-control">

                                        </div>
                                        <div class="col-12 col-md-4 py-5">
                                        <a href="myaccount.php" class="btn btn-outline-warning form-control back"> Back </a>


                                            </td>
                                        </div>
                                    </div>
                                </div>
                </form>

                <?php

        }

        ?>
                    </div>
                    </div>x
        </div>
        <?php 
}
else{
    header("location:index.php");
}
include "footer.php"; 
?>
            <script>
                $('#profilephotohover').click(function() {
                    $('#inputUpload').click();
                });

                function showPhoto() {
                    var file = document.getElementById('inputUpload').files[0];
                    console.log(file);
                    reader = new FileReader();
                    // console.log(reader);
                    reader.onloadend = function() {
                        $('#img1').attr('src', reader.result);
                        // console.log(reader.result);
                    };

                    reader.readAsDataURL(file);
                }
            </script>