<?php

    /*include  "WarrantyRecord.class.php";
    $obj  = new WarrantyRecord();
    $msg = $obj->getWarrantyRecord("*","","","",false);
    echo $msg;*/
    spl_autoload_register(function($class) {
        include  $class . '.class.php';
    });
    $obj = new WarrantyRecord();
    $msg = $obj->getWarrantyRecord("*","","","",false);
    echo $msg;
    /*
    try 
    { 
        $query = "select * from wdbt.vwWarranty";
        $config  = array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES => false);
        $con = new PDO("mysql:host=localhost; dname = wdbt;charset=utf8"."","root" ,"root",$config);
        $stmt = $con->prepare($query);
        $stmt->execute();
        echo $stmt->rowCount() . "<br>";
        if($stmt->rowCount()>0)
        {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //$msg = json_encode($result);
            echo "|".json_encode($result)."|". "<br>";
            echo json_last_error_msg();
            //print_r($result);
        }
        else
        {
            $msg = $this->generateResponse(TRUE, $this->messages['nrf'], FALSE);
            return $msg;
        }
    }
    catch(PDOException $e)
    {
        $msg = $this->generateResponse(TRUE, $e->getMessage(),TRUE);
        return $msg;
    }//catch     */
?>