<?php

spl_autoload_register(function($class) {
    include $class . '.class.php';
});
    $obj  = new Customer();
    $obj->table = "x";
    $msg = $obj->getCustomer("","*","","","");
    //echo $msg;
    $cust = json_decode($msg);
    //print_r($cust);
    $custData = json_decode($cust->data,true);
    print_r($custData);
?>