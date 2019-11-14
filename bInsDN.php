<?php

    $file = fopen("dn.csv","r");
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
            
            print_r($wData);
            echo "<br>";
            try
            {
                $query = "Insert into wdbt.tblcertifications VALUES(NULL,";
                $query .= "" .$wData[0] . ", ";
                $query .= "" .$wData[1] . ", ";
                $query .= "'" .$wData[2] . "', ";
                $query .= "'" .$wData[3] . "', ";
                $query .= "'" .$wData[4] . "', ";
                $query .= "" .$wData[5] . ", ";
                $query .= "'" .$wData[6] . "') ";                
                echo $query . "<br><br>";
                $stmt = $con->prepare($query);
                $stmt->execute();
                $s++;
            }
            catch(PDOException $e)
            {
                $e++;
                echo $e->getMessage();
                //$con->rollBack();
                
            }//catch 
            $c++;
        }
    //$con->commit();
    echo "<hr>";
    echo "Success : $s" . "<br>";
    echo "Error : $e". "<br>";
    echo "Total : $c". "<br>";
    ?>               