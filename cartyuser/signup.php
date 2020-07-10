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
                include_once "customer.php";
                $cust = new  customer();
                if (isset($_POST['regSingUp'])) {
                    if(isset($_POST['regcheck'])){
                    
                        if ($_POST['regPassword'] === $_POST['regRePassword']) {
                            //    echo("MATCHED");
                            $regPhone = "/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/";
                            $reg="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/"; //Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character
                            if(preg_match($reg,$_POST['regPassword'])){
                                 
                                    $cust->setFName($_POST['regFName']);
                                    $cust->setLName($_POST['regLName']);
                                    $cust->setEmail($_POST['regEmail']);
                                    $cust->setPassword(sha1($_POST['regPassword']));
                                    $msg = $cust->add();
                                    $custId = $cust->lastCustId();
                                    // echo($custId);
                                    if($msg=="ok"){
                                        include_once "address.php";
                                        $add = new  address();
                                        $add->setId($custId);
                                        $add->setphone($_POST['regPhone']);
                                        $add->setcity($_POST['regCity']);
                                        $add->setarea($_POST['regArea']);
                                        $add->setstreet($_POST['street']);
                                        $add->setbuildno($_POST['regBuildingNo']);
                                        $add->setfloorno($_POST['regFloorNo']);
                                        $add->setaddstyp($_POST['regAddressType']);
                                        $add->setstatus('primary');

                                        $msg2 = $add->addFirstAdd();
                                        if($msg2 = 'ok'){
                                        echo('<div class="alert alert-success text-center" role="alert">USER HAS BEEN CREATED</div>');       
                                        header('Refresh:3; url=login.php');
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
            <h4 class="login-title ">Sign Up</h4><br><br>
            <div class="row ">
                <div class="col-md-6 col-12 mb--20">
                    <!-- <label>First Name</label> -->
                    <input type="text" class="form-control" placeholder="First name" name="regFName">
                </div>
                <div class="col-md-6 col-12 mb--20">
                    <!-- <label>Last Name</label> -->
                    <input type="text" class="form-control" placeholder="Last name" name="regLName">
                </div>
                <div class="col-md-12">
                    <!-- <label>Email Address*</label> -->
                    <input type="email" class="form-control"  placeholder="Email "name="regEmail" id="email">
                    <span id="emailMsg" class="text-danger"></span>
                </div>
                <div class="col-md-12">
                    <!-- <label>Email Address*</label> -->
                    <input type="phone" class="form-control" placeholder="Phone number" name="regPhone">
                </div>
                <div class="col-md-6">
                    <!-- <label>Password</label> -->
                    <input type="password" class="form-control" placeholder="Password" name="regPassword" id="txtpassword">
                    <span toggle="#txtpassword" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                </div>
                <div class="col-md-6">
                    <!-- <label>Confirm Password</label>     -->
                    <input type="password" class="form-control" placeholder="Confirm Password" name="regRePassword" id="txtconfirm">
                    <span toggle="#txtconfirm" class="fa fa-fw fa-eye field-icon toggle-password" ></span>
                </div>
                <div class="form-row col-md-12">
                    <div class="col-md-6">
                        <label for="inputCity"> <b> City <i class="fas fa-city"></i></b> </label>
                        <select id="inputState" class="form-control" name="regCity">
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
                        <input type="text" class="form-control" id="inputArea"  name="regArea">
                    </div>
                </div>
                <div class="form-row col-md-12">
                
                <label for="inputAddressTypea"> <b> Street <i class="fas fa-road"></i></b> </label>
                <input type="text" class="form-control" id="inputAddressTypea"  name="street">
            
                </div>

                <div class="form-row col-md-12">
                    <div class="col-md-6">
                        <label for="inputCity"> <b> Building Number </b> </label>
                        <input type="text" class="form-control" id="inputBuildingNo"  name="regBuildingNo">
                    
                    </div>
                    <div class="col-md-6">
                        <label for="inputState"><b> Floor Number </b></label>
                        <input type="text" class="form-control" id="inputFloorNo"  name="regFloorNo">
                    </div>
                </div>
                
                <div class="form-row col-md-12">
                
                        <label for="inputCity"> <b> Address Type </b> </label>
                        <input type="text" class="form-control" id="inputAddressType"  name="regAddressType">
                    
                </div>
                
                <div class="form-group col-md-6">
                    <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="customCheck1" name="regcheck">
                    <label class="custom-control-label" for="customCheck1">I accept terms and conditions</label>
                    </div>
                </div>
                
                <div class="col-12">
                    <button type="submit" class="uren-register_btn" name="regSingUp">Register</button>
                </div>

            </div>


                   </div>
    </form>
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
                    url: 'ajax/ajaxcust.php',
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