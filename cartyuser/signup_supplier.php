<?php
ob_start();
include "headerbefore.php";
?>
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
   
<div id="signupform" class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
    <form method="post">



    <?php
    include_once "supplier.php";
    $supp = new  supplier();
    if (isset($_POST['regSingUp'])) {
        if(isset($_POST['regcheck'])){
           
            if ($_POST['regPassword'] === $_POST['regRePassword']) {
                //    echo("MATCHED");
                $regPhone = "/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/";
                $reg="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/"; 
                if(preg_match($reg,$_POST['regPassword'])){
          
                            
                    if(preg_match($regPhone,$_POST['regPhone'])){
                        $supp->setname($_POST['txtname']);
                        $supp->setshopName($_POST['shopName']);
                        $supp->setemail($_POST['regEmail']);
                        $hash = password_hash($_POST['regPassword'], PASSWORD_BCRYPT);
                        $supp->setpassword($hash);
                        $supp->setdetails($_POST['details']);
                        $supp->setopentime($_POST['opentime']);
                        $supp->setendtime($_POST['closetime']);
                        $supp->setendtime($_POST['closetime']);
                        $msg = $supp->add();
                        if($msg=="ok"){
                            $suppId = $supp->lastSuppId();
                            $supp->setsuppId($suppId);
                            $supp->setphone($_POST['regPhone']);
                            $supp->setcity($_POST['regCity']);
                            $supp->setarea($_POST['regArea']);
                            $supp->setstreet($_POST['street']);
                            $supp->setbuildingNo($_POST['regBuildingNo']);
                            
                            $msg2 = $supp->getsupplierscities();
                            if($msg2 = 'ok'){
                            echo('<div class="alert alert-success text-center" role="alert">your Account has been created </div>');
                                   
                            // header('Refresh:3; url=login.php');
                            }else if(strpos($msg,'phone')){
                                echo('<div class="alert alert-danger text-center" role="alert"> THIS PHONE ALREADY EXIST </div>');
                            }else{
                                echo('<div class="alert alert-danger text-center" role="alert">ERROR IS : '.$msg2.'</div>');
                            }
                        }
                        else if(strpos($msg,'email'))
                            echo('<div class="alert alert-danger text-center" role="alert"> THIS EMAIL ALREADY EXIST </div>');
                    
                        else
                            echo('<div class="alert alert-danger text-center" role="alert">ERROR IS : '.$msg.'</div>');

                    }else{
                        $errPhone = 'Phone must be EX: +20 000 000 000';
                    }

                        
                            
                }
                else{
                    echo('<div class="alert alert-danger text-center" role="alert">PASSWORD IS WEAK</div>');
                }
            }
            else{
                echo('<div class="alert alert-danger text-center" role="alert">PASSWORD NOT MATCHED</div>');
                
            }
        }
        else{
            echo('<div class="alert alert-warning text-center" role="alert">You should accept terms and conditions</div>');
        }
    }
?>




        <div class="login-form">
            <h4 class="login-title ">Sign Up supplier</h4><br><br>
            <div class="row ">
                <div class="col-md-12 col-12 mb--20">
                    <!-- <label>Name</label> -->
                    <input type="text" class="form-control" placeholder="Name" name="txtname"  autofocus/>
                    <span><?php if(isset($errName)) echo($errName) ?></span>
                </div>
                <div class="col-md-12">
                    <!-- <label>Email Address*</label> -->
                    <input type="email" class="form-control" id="email" placeholder="Email "name="regEmail"  />
                    <span id="emailMsg" class="text-danger"></span>
                </div>
                
                <div class="col-md-6">
                    
                    <input type="password" class="form-control" placeholder="Password" name="regPassword" id="txtpassword"  >
                    <span toggle="#txtpassword" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                </div>
                <div class="col-md-6">
                    <!-- <label>Confirm Password</label>     -->
                    <input type="password" class="form-control" placeholder="Confirm Password" name="regRePassword" id="txtconfirm"  >
                    <span toggle="#txtconfirm" class="fa fa-fw fa-eye field-icon toggle-password" ></span>
                   
                    
                </div>
                <div class="col-md-6">
                        <label for="inputState"><b> Phone <i class="fas fa-mobile-alt"></i></b></label>
                        <input type="phone" class="form-control" placeholder="Phone Number" name="regPhone"  >
                        <span class="text-danger"><?php if(isset($errPhone)) echo($errPhone); ?></span>
                    </div>
                    <div class="col-md-6">
                        <label for="inputState"><b> Shop Name <i class="fas fa-store"></i></b></label>
                        <input type="text" class="form-control" id="inputArea"  name="shopName" placeholder="Shop Name"  >
                    </div>
                <div class="form-row col-md-12">
                    <div class="col-md-6">
                        <label for="inputCity"> <b> City <i class="fas fa-city"></i></b> </label>
                        <select id="inputState" class="form-control" name="regCity"  >
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
                    <div class="col-md-6">
                        <label for="inputState"><b> Area </b></label>
                        <input type="text" class="form-control" id="inputArea"  name="regArea"  >
                    </div>
                    
                </div>
                <div class="form-row col-md-12">
                    <div class="col-md-6">
                        <label for="inputAddressTypea"> <b> Street <i class="fas fa-road"></i></b> </label>
                        <input type="text" class="form-control" id="inputAddressTypea"  name="street"  >
                    </div>
                    <div class="col-md-6">
                        <label for="inputCity"> <b> Building Number </b> </label>
                        <input type="text" class="form-control" id="inputBuildingNo"  name="regBuildingNo"  >
                    
                    </div>
                </div>
                <div class="form-row col-md-12">
                    <div class="col-md-4">
                        <label for="inputCity"> <b> Open Time <i class="far fa-clock"></i></b> </label>
                        <input type="time" class="form-control timepicker" id="inputBuildingNo"  name="opentime"  >
                    
                    </div>
                    <div class="col-md-4">
                        <label for="inputState"><b> Close Time <i class="fas fa-clock"></i></b></label>
                        <input type="time" class="form-control timepicker" id="inputFloorNo"  name="closetime"  >
                    </div>
                    
                </div>
                
                <div class="form-row col-md-12">
                
                        <label for="inputCity"> <b> Details </b> </label>
                        <textarea name="details" id="" cols="100" rows="4"  ></textarea>                    
                </div>
                
                <div class="form-group col-md-6">
                    <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck1" name="regcheck">
                    <label class="custom-control-label" for="customCheck1">I accept terms and conditions</label>
                    </div>
                </div>
                
                <div class="col-12">
                    <button type="submit" class="uren-register_btn" name="regSingUp" id='sub'>Register</button>
                </div>

            </div>

            
                   </div>
    </form>
</div>


<script>
// password show and hide 
$(".toggle-password").click(function() {

$(this).toggleClass("fa-eye fa-eye-slash");
var input = $($(this).attr("toggle"));
if (input.attr("type") == "password") {
    input.attr("type", "text");
} else {
    input.attr("type", "password");
}
});

// confirm password
    $(document).ready(function(){
          
          $("#txtconfirm").bind('keyup change', function(){

            check_Password( $("#txtpassword").val(), $("#txtconfirm").val() );
            
            
          })

       
        })
        
        function check_Password( Pass, Con_Pass){
      
          if(Pass === ""){
          

          }else if( Pass === Con_Pass){

            
            $("#txtpassword").removeClass("is-invalid");
            $("#txtconfirm").removeClass("is-invalid");
            $("#txtpassword").addClass("is-valid");
            $("#txtconfirm").addClass("is-valid");
            
            

          }else{
            $("#txtpassword").removeClass("is-valid");
            $("#txtconfirm").removeClass("is-valid");
            $("#txtpassword").addClass("is-invalid");
            $("#txtconfirm").addClass("is-invalid");
           

           

          }

        }

  



// check email
$(document).ready(function(){
    $('#email').blur(function(){
        email = $('#email').val()
        console.log(email);
        $.ajax(
                {
                    url: 'ajax/Varifyajax.php',
                    method: 'POST',
                    data: {
                        emailAjax: email
                    },
                    success: function (data) {
                       
                       if(data !=''){
                        //    $("#email").val("");
                           $("#emailMsg").html(data);
                       }
                        console.log(data);   
                    },
                    dataType: 'text'
                }
            );
            
        
        }); 

});
</script>




<?php
include "footer.php";
?>