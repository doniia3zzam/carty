<?php
ob_start();
session_start();
if(isset($_SESSION['username'])){
    include "headerafter.php";

?>
    <?php 
    if(isset($_POST["addrs"])){
        include_once "address.php";
        $addrs=new address();
    //    echo $_SESSION['userid'];
        $addrs->setId($_SESSION['userid']);
        $addrs->setcity($_POST["txtcity"]);
        $addrs->setstreet($_POST["txtstreet"]);
        $addrs->setarea($_POST["txtarea"]);
        $addrs->setbuildno($_POST["txtbuildingno"]);
        $addrs->setfloorno($_POST["txtfloorno"]);
        $addrs->setphone($_POST["txtphone"]);
        $addrs->setaddstyp($_POST["txtaddresstype"]);
       $ad= $addrs->add();
       if(isset($ad)){
           header('location:myaccount.php');
        // echo "address added";
    }
    else
    echo  $ad;

    }

    ?>
    <?php



?>
        <div class="container-fluid">
            <div class="row my-3">
                <div class="col-6">
                <form method="post">
                    <div class="card ">
                        <div class="card-header ">
                            <div class="  text-center">
                                <label><b>user name</b></label>
                                <br/>
                                <label class="form-control">
                                    <?php echo $_SESSION['username']; ?>
                                </label>
                            </div>
                        </div>
                        <div class="card-body offset-md-3">
                            <div class="row">
                                <div class=" col-12 col-md-8">
                                    <label for="inputCity"> <b> City </b> </label>
                                    <select id="inputState" class="form-control" name="txtcity">
                                        <?php

                                            include_once "city.php";
                                            $city = new city();
                                            $result = $city->getAll();
                                            while($rows = mysqli_fetch_assoc($result)){
                                                echo("<option value='".$rows['city_id']."'>".$rows['name']."</option>");
                                            }

                                            ?>

                                    </select>

                                </div>
                            </div>
                            <div class="row">
                                <div class=" col-12 col-md-8">
                                    <label class="label"><b>area</b></label>
                                    <input type="text" class="form-control" name="txtarea" />
                                </div>
                            </div>

                            <div class="row">
                                <div class=" col-12 col-md-8">
                                    <label class="label"><b>street</b></label>
                                    <input type="text" class="form-control" name="txtstreet" />
                                </div>
                            </div>
                            <div class="row">
                                <div class=" col-12 col-md-8">
                                    <label class="label"><b>phone</b></label>
                                    <input type="text" class="form-control" name="txtphone" />
                                </div>
                            </div>

                            <div class="row ">
                                <div class=" col-12 col-md-4">
                                    <label class="label"><b>buildungNo</b></label>
                                    <input type="text" class="form-control" name="txtbuildingno" />
                                </div>

                                <div class=" col-12 col-md-4">
                                    <label class="label"><b>floorNo</b></label>
                                    <input type="text" class="form-control" name="txtfloorno" />
                                </div>
                            </div>
                            <div class="row ">
                                <div class=" col-12 col-md-8">
                                    <label class="label"><b>Address Type</b></label>
                                    <input type="text" class="form-control" name="txtaddresstype" />
                                </div>

                            </div>
                        </div>
                        <div class="card-footer text-center " style="width: 100%;">
                            <br>
                            <div class="row">
                                <div class="offset-3 col-3">
                                    <input class="btn btn-success form-control" type="submit" value="add address" name="addrs" />
                                </div>

                                <div class="col-3">
                                    <a href="myaccount.php" class="btn btn-secondary form-control">back </a>
                                </div>
                            </div>
                            <br>
                        </div>

                    </div>
                </form>
                </div>
                
                <div class="col-6 text-center">
                    <?php
                    if(isset($_POST['addLoc'])){
                      
                        include_once "address.php";
                        $Add = new address();
                        $res = $Add->AddLoc($_POST['phone'],$_POST['addressType'],$_POST['long'],$_POST['lat'],$_SESSION['userid']);
                        if($res == 'ok'){
                            ?>
                                <div class="alert alert-success text-center"> You Have added a new location </div>
                                
                           <?php
                            
                            header("Refresh:10; url=myaccount.php");
                        }
                        else{
                            // echo($res);
                            ?>
                                 <div class="alert alert-danger text-center">This Phone is already exist </div>
                            <?php
                        }
                            
                        
                    }
                    // echo('hello');
                    ?>
                    <h2 class="display-4"> Try Set Location Using</h2>
                    <br>
                    <img src="assets/images/Gmap.png" alt="" style="cursor:pointer;"  data-toggle="modal" data-target="#exampleModalCenter">

                    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                        Launch demo modal
                    </button>
                     -->
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document" style="min-width: 800px;">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Choose your location</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <form method="POST" onsubmit="return Validation()">

                                <div class="modal-body">
                                    <div id="map-canvas"></div>
                                    <br>
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter Phone Number" required> 
                                        </div>
                                        <div class=" col-6">
                                             <input type="text" name="addressType" id="addressType" class="form-control" placeholder="Enter Address Type"required>   
                                        </div>
                                        
                                        <input type="hidden" name="lat" id="inputLat" required>
                                        <input type="hidden" name="long" id="inputLong" required>
                                        <script>
                                           
                                            function Validation()
                                            {

                                                if($('#inputLat').val() == "" || $('#inputLong').val() == ""){
                                                    alert('Yout Must Choose Your Current Location');
                                                    return  false;
                                                }

                                                if($('#phone') == "" || $('#addressType') == ""){
                                                    alert('Yout Must Enter Your All Informations');
                                                    return  false;
                                                }

                                                return true;
                                            }
                                            
                                        </script>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" >Close</button>
                                    <button type="submit" class="btn btn-primary" name="addLoc">Add Location</button>
                                </div>
                            </form>

                        </div>
                        </div>
                    </div>
                    <!-- <script src="https://maps.google.com/maps/api/js?sensor=false&amp;libraries=geometry&amp;v=3.22&amp;key=AIzaSyChs2QWiAhnzz0a4OEhzqCXwx_qA9ST_lE"></script> -->
                    <script type="text/javascript"src="https://maps.googleapis.com/maps/api/js?language=en&key=AIzaSyDS5AwUrTwTyRSjOA3KFWFnGFVe-6v8UOM"></script>
                    <script src="assets/js/SetMarkerGMap.js"></script>                       
                </div>
            </div>
        </div>
        

        

        <?php 
}else{
    header("location:index.php");
    } 
include "footer.php"; ?>