<?php

    $file = fopen("resources/customerBranches.csv","r");
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


                //echo "Insert into wdbt.tblwarranty VALUES(':citilInvoiceNo',STR_TO_DATE(':citilInvoiceDate','%d/%m%/Y'), :custId,':prodNo',':prodDesc',':prodSerial',:prodQty,:distId,':distInvoiceNo', STR_TO_DATE(':distInvoiveDate','%d/%m/%Y'),:warrExYears, STR_TO_DATE(':warrExpDate','%d/%m/%Y')" . "<br>";
                /*
                $stmt = $con->prepare("Insert into wdbt.tblwarranty VALUES('NULL,:citilInvoiceNo',STR_TO_DATE(':citilInvoiceDate','%d/%m%/Y'),:custId,':prodNo',':prodDesc',':prodSerial',:prodQty,:distId,':distInvoiceNo',STR_TO_DATE(':distInvoiceDate','%d/%m/%Y'),:warrExYears), STR_TO_DATE(':warrExpDate','%d/%m/%Y')");
                $stmt->bindParam(':citilInvoiceNo', $wData[0], PDO::PARAM_STR);   
                $stmt->bindParam(':citilInvoiceDate', $wData[1], PDO::PARAM_STR);   
                $stmt->bindParam(':custId', $wData[2], PDO::PARAM_INT);   
                $stmt->bindParam(':prodNo', $wData[3], PDO::PARAM_STR);   
                $stmt->bindParam(':prodDesc', $wData[4], PDO::PARAM_STR);   
                $stmt->bindParam(':prodSerial', $wData[5], PDO::PARAM_STR);   
                $stmt->bindParam(':prodQty', $wData[6], PDO::PARAM_INT); 
                $stmt->bindParam(':distId', $wData[7], PDO::PARAM_INT);   
                $stmt->bindParam(':distInvoiceNo', $wData[8], PDO::PARAM_STR);   
                $stmt->bindParam(':distInvoiveDate', $wData[9], PDO::PARAM_STR);   
                $stmt->bindParam(':warrExYears', $wData[10], PDO::PARAM_INT);   
                $stmt->bindParam(':warrExpDate', $wData[11], PDO::PARAM_STR);   
                print_r($stmt);
            
                //$stmt->execute();
                $query = sprintf("Insert into wdbt.tblwarranty VALUES(NULL, '%s', STR_TO_DATE('%s','%d/%m%/Y') , %d,  '%s',  '%s',  '%s', %d, %d, '%s',  STR_TO_DATE('%s','%d/%m%/Y'), %d,  STR_TO_DATE('%s','%d/%m%/Y') ",
                $wData[0],$wData[1],$wData[2],$wData[3],$wData[4],$wData[5],$wData[6],$wData[7],$wData[8],$wData[9],$wData[10],$wData[11]);
                */

                $query = "Insert into wdbt.tblcustomerbranches VALUES(NULL,";
                $query .= "" .$wData[0] . ", "; //custId
                $query .= "" .$wData[1] .")"; //branchId
            
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