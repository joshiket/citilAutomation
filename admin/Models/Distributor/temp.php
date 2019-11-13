<?php

    include  "Distributor.class.php";
    $obj  = new Distributor();
    $msg = $obj->getDistributor("","*","","","");
    echo $msg;
?>