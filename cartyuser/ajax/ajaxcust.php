<?php
//   customer  

if(isset($_POST['emailAjax'])) {
    include_once "../customer.php";
    $cust = new customer();
    $res1 = $cust->checkEmailajax($_POST['emailAjax']);
    $message = '';
    if($row = mysqli_fetch_assoc($res1)){
        $message = 'This email is already exist';
    }
    exit($message);
    
}
?>