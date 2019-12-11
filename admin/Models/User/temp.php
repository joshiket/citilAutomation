<?php

    include  "User.class.php";
    $obj = new User();
    //echo $obj->encryptAsync("admin789");    
    $obj->usrEmail = "admin@admin.com";
    $obj->usrPass = "admin123";
    $obj->newPass ="admin789";
    $msg = "";
    $msg = $obj->changePassword();
    /*
    $msg = $obj->login();
    echo $msg;
    
    
    $msg = json_decode($msg);
    var_dump($msg);
    
    if(is_object($msg))
    {
        if(!$msg->error)
        {
            $obj->usrPass = $obj->encryptAsync($obj->newPass);
            $query = sprintf("UPDATE %s SET usrPass = '%s' WHERE usrEmail ='%s' ",$obj->table,$obj->usrPass,$obj->usrEmail);
            echo $query;
            //$msg = $obj->saveUser($query);
        }
        else
        {
            $msg = $obj->generateResponse(TRUE, $obj->messages['usrloginerr'], FALSE);
        }
    }
    else
    {
        $msg = $obj->generateResponse(TRUE,"Unknown error.",FALSE);
    }*/
    echo $msg;  
?>