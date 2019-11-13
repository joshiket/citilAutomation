<?php

    include  "Customer.class.php";
    $obj  = new Customer();
    $custId = 11;
    $msg = $obj->getCustomer("","*"," where custId =".  $custId,"");
    echo $msg;
?>