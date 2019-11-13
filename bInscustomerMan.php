<?php

    $file = fopen("customermanager.csv","r");
    //$wData = fgetcsv($file, 10000, ",");
    //print_r($wData);
    $c = 0;
    $s = 0;
    $e= 0;

        $config  = array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES => false);
        $con = new PDO("mysql:host=localhost;"." dname = wdbt"  ." ", "root" ,"root" ,$config);
        $con->beginTransaction();
        while (($wData = fgetcsv($file, 10000, ",")) !== FALSE)
        {
                        
            try
            {
                $config  = array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES => false);
                $con = new PDO("mysql:host=localhost;"." dname = wdbt"  ." ", "root" ,"root" ,$config);
                $query = sprintf("INSERT INTO wdbt.tblcustomermanager VALUES(NULL,'%d','%d')",$wData[1],$wData[2]);
                echo $query;
                $stmt = $con->prepare($query);
                $stmt->execute();
                $s++;
            }
            catch(PDOException $e)
            {
                
                echo $e->getMessage();
                $e++;
                
            }//catch      
            $c++ ;       
        }
        $con->commit();
        echo "<hr>";
        echo "Success : $s" . "<br>";
        echo "Error : $e". "<br>";
        echo "Total : $c". "<br>";
?>