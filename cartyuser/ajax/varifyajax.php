<?php

if(isset($_POST['emailAjax'])) {
    include_once "../supplier.php";
    $supp = new supplier();
    $res = $supp->checkEmail($_POST['emailAjax']);
    $message = '';
    if($row = mysqli_fetch_assoc($res)){
        $message = 'This email is already exist';
    }
    exit($message);
    
}



?>