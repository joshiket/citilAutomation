<?php

    include  "Manager.class.php";
    $obj  = new Manager();
    $msg = $obj->getManager("*","","","",false);
    echo $msg;
?>