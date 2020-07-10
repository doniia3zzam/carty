<?php
ob_start();
session_start();

if(isset($_SESSION['username']))
{
include "headerafter.php";
}
?>
    <section class="container my-5">
        <?php
    include_once "customer.php";
    $cust = new customer();
    $cust->setId($_SESSION['userid']);
    $result = $cust->getAll();
    if($row=mysqli_fetch_assoc($result))
    {
?>
            <div class="row  align-items-center">

                <div class="col-4">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-6 ">
                                <label class="display-4 text-capitalize ">
                                    <?php echo($row['first_name']);?>&nbsp;
                                        <?php echo($row['last_name']);?>
                                </label>
                            </div>
                        </div>
                        <div class="col-3 my-2">
                            <label style="font-size: 1.25rem;font-weight: 300;"><b>Email:</b></label>
                        </div>
                        <div class="col-6 my-2">
                            <label style="font-size: 1.25rem;font-weight: 300;">
                                <?php echo($row['email']) ?>
                            </label>
                        </div>
                        <div class="text-center m-auto">
                            <form method="post" enctype="multipart/form-data">

                                <img src="../public/assets/images/customer/<?php echo($row['photo_name']) ?>" alt="" style="cursor:pointer;height:250px; width:250px " id="prof" class="rounded-circle ">
                                <input id="file" style="display: none;" type="file" name="file" onchange="showPhoto()" />
                                <div class="">
                                    <button type="submit" name="change" id="change" class="btn btn-outline-success my-2" style="display:none;">Save</button>
                                </div>
                            </form>
                            <div class=" col-12 my-3">
                                <p class="d" id="changePass" style="cursor: pointer"> Change Password <i class="fas fa-key"></i> </p>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-6 offset-1" id="Profile">
                    <?php
        $result2 = $cust->getProfile();
        $i = 0;
        ?>

                        <label style="font-size: 1.25rem;font-weight: 300;"><b>Addresses:</b></label>

                        <div class="accordions ">
                            <?php
                 while($row=mysqli_fetch_assoc($result2))
                 {
                ?>
                                <div class="accordion-item">
                                    <div class="accordion-title" data-tab="item<?php echo($i) ?>">
                                        <h2><?php echo($row['addressStatus'])  ?> <i class="fas fa-chevron-down"></i></h2>
                                    </div>
                                    <div class="accordion-content" id="item<?php echo($i) ?>">

                                        <table class="d-block">
                                            <tr>
                                                <td class="td"><b>City</b></td>
                                                <td class="text-center td">
                                                    <?php echo($row['city'])  ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="td"><b> Phone</b></td>
                                                <td class="text-center td">
                                                    <?php echo($row['phone'])  ?>
                                                </td>
                                            </tr>
                                            <?php if($row['lat'] == ""){ ?>
                                                <tr>
                                                    <td class="td"><b>Address</b></td>
                                                    <td class="text-center td">
                                                        <?php echo($row['customerAddress'])  ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="td"><b>Area</b></td>
                                                    <td class="text-center td">
                                                        <?php echo($row['area'])  ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="td"><b>Building No</b></td>
                                                    <td class="text-center td">
                                                        <?php echo($row['buildingNo'])  ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="td"><b>Floor No</b></td>
                                                    <td class="text-center td">
                                                        <?php echo($row['floorNo'])  ?>
                                                    </td>
                                                </tr>
                                                <?php
                        }else
                        {
                        ?>
                                                    <tr>
                                                        <td class="td"><b>Location</b></td>
                                                        <td class="text-center td">Set By Google Maps</td>
                                                    </tr>
                                                    <?php }
                        ?>
                                                        <tr>
                                                            <td class="td"><b>Address Type</b></td>
                                                            <td class="text-center td">
                                                                <?php echo($row['addressType'])  ?>
                                                            </td>
                                                        </tr>
                                        </table>

                                    </div>
                                </div>

                                <?php
                $i++;
                 }
                ?>
                        </div>

                        <script>
                            $(document).ready(function() {
                                $(".accordion-title").click(function(e) {
                                    var accordionitem = $(this).attr("data-tab");
                                    $("#" + accordionitem).slideToggle().parent().siblings().find(".accordion-content").slideUp();

                                    $(this).toggleClass("active-title");
                                    $("#" + accordionitem).parent().siblings().find(".accordion-title").removeClass("active-title");

                                    $("i.fa-chevron-down", this).toggleClass("chevron-top");
                                    $("#" + accordionitem).parent().siblings().find(".accordion-title i.fa-chevron-down").removeClass("chevron-top");
                                });

                            });
                        </script>
                        <div class="my-3 text-right">
                            <a href="myaccount.php"> Change Or Add Address <i class="fas fa-plus-circle"></i></a>
                        </div>
                </div>

                <div class="col-6 offset-1 d-none" id="changePassForm">
                    <div class="row">
                        <div class="col-8 offset-2">
                            <h5 class="text-center my-4">Change your password</h5>
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
                                    <span class="btn btn-outline-dark" id="back"> Back </span>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
                <script>
                    $('#changePass').on('click', function() {
                        $('#Profile').addClass('d-none');
                        $('#changePassForm').removeClass('d-none');
                    });
                    $('#back').on('click', function() {
                        $('#changePassForm').addClass('d-none');
                        $('#Profile').removeClass('d-none');
                    });
                </script>

            </div>
            <?php

        if(isset($_POST['change'])){
            $file = $_FILES['file'];
            // print_r($file);
            $fileName = $_FILES['file']['name'];
            $fileExtention = explode('.',$fileName);
            $actualFileExtention = strtolower(end($fileExtention));
            $allowedExt = array('jpg','png','jpeg');

            $fileSize = $_FILES['file']['size'];
            $fileTmpName = $_FILES['file']['tmp_name'];
            $fileError = $_FILES['file']['error'];
            $fileType = $_FILES['file']['type'];
            // echo($filename);

            if(in_array($actualFileExtention,$allowedExt)){
                if($fileError === 0){
                   if($fileSize < 50000000) {
                        $fileNameNew = time().'.'.$actualFileExtention;
                        $fileDest = '../public/assets/images/customer/'.$fileNameNew;
                        move_uploaded_file($fileTmpName,$fileDest);
                        $cust->getimage($fileNameNew,$_SESSION['userid']);
                        $_SESSION['photo'] = $fileNameNew;
                        // echo('<img src="'.$fileDest.'" width=200 height=200 class="hello">');
                        clearstatcache();
                        header('location:custprofile.php');

                    }else{
                        echo("Too big!");
                    }
                }else{
                    echo("ERROR try again");
                }
            }else{
                echo("you cannt upload");
            }
        }

    ?>
                <?php

if(isset($_POST['actsub2'])){

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
                            header("Refresh:2; url=custprofile.php");

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
                    <?php

}
?>

    </section>

    <?php include "footer.php"; ?>
        <script>
            $("#prof").click(function() {
                $("#file").click();
            })

            function showPhoto() {
                var file = document.getElementById('file').files[0];
                // console.log(file);
                reader = new FileReader();
                // console.log(reader);
                reader.onloadend = function() {
                    $('#prof').attr('src', reader.result);
                    $('#change').fadeIn();
                    // console.log(reader.result);
                };

                reader.readAsDataURL(file);
            }
        </script>
