<?php

    include  "Notification.class.php";
    $obj = new Notification();
    $msg = $obj->getW5D();
    echo $msg;
?>