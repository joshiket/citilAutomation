<?php

    include  "User.class.php";
    $obj = new User();
    //echo $obj->encryptAsync("admin789");    
    $msg = $obj->getUser("usrSecuAns", " WHERE usrEmail = 'kiran_t@citilindia.com' ","","");
    //echo $msg;
    $msg = json_decode($msg);
    //print_r($msg);
    if(is_object($msg) && (!$msg->error))
    {
        $msg = json_decode($msg->data);
        $msg = $msg[0];
        var_dump($msg);

        echo $msg->usrSecuAns;
    }
    
?>