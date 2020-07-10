<?php
session_start();
session_destroy();
setcookie("userCookie","",time()-1);
header('location:index.php');

?>