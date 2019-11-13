<?php

    include  "User.class.php";
    $usrObj = new User();
    //echo $usrObj->encryptAsync("admin789");    
    $usrObj->usrEmail = "admin@admin.com";
    $usrObj->usrPass = "admin789";
    $msg =  $usrObj->login();
    echo $msg;
?>