<?php
            function generateResponse($error, $msg, $data)
            {
                $msgArr['error'] = $error;
                if($data)
                    $msgArr['data'] = $msg;
                else
                    $msgArr['msg'] = $msg;
                return json_encode($msgArr);
            } // generateResponse()            

            function getDistinctACManagers()
            {
                try 
                { 
                    $query = sprintf("SELECT distinct acMan, Email  FROM %s","wdbt.vw90days");
                    $config  = array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES => false);
                    $con = new PDO("mysql:host=localhost; dbname = wdbt;charset=utf8", "root" ,"root" ,$config);
                    $stmt = $con->prepare($query);
                    $stmt->execute();
                    if($stmt->rowCount()>0)
                    {
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        $msg = generateResponse(FALSE, json_encode($result),TRUE);
                        return $msg;
                    }
                    else
                    {
                        $msg = generateResponse(TRUE, "No records found.", FALSE);
                        //return $msg;
                        echo "No records found.";
                    }
                }
                catch(PDOException $e)
                {
                    $msg = generateResponse(TRUE, $e->getMessage(),TRUE);
                    return $msg;
                }//catch             
            }
            function getManagerWarrantyRecords($acMan)
            {
                $query = sprintf("SELECT custName,prodNo,prodSerial,prodDesc,prodQty,expDate FROM %s WHERE acMan='%s'","wdbt.vw90days",$acMan);
                try 
                { 
                    
                    $config  = array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES => false);
                    $con = new PDO("mysql:host=localhost; dbname = wdbt;charset=utf8", "root" ,"root" ,$config);
                    $stmt = $con->prepare($query);
                    $stmt->execute();
                    if($stmt->rowCount()>0)
                    {
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        $msg = generateResponse(FALSE, json_encode($result),TRUE);
                        return $msg;
                    }
                    else
                    {
                        $msg = generateResponse(TRUE, "No records found.", FALSE);
                        //return $msg;
                        echo "No records found.";
                    }
                }
                catch(PDOException $e)
                {
                    $msg = generateResponse(TRUE, $e->getMessage(),TRUE);
                    return $msg;
                }//catch                    
            }
            $manager = getDistinctACManagers();
            $manager= json_decode($manager);
            //$mangerss = json_decode($managers[0],TRUE);
            print_r($manager);
            echo "<br>";
            if(!$manager->error)
            {
                //echo $managers->data[0];
                $managers = $manager->data;
                $managers = json_decode($managers,TRUE);
                for($i =0; $i<sizeof($managers);$i++)
                {
                    $managerRecord = getManagerWarrantyRecords($managers[$i]['acMan']);
                    $managerRecord = json_decode($managerRecord);
                    if(!$managerRecord->error)
                    {
                        $managerRecords =json_decode($managerRecord->data,TRUE);
                        $mailContent = "<table border=\"1\" cellspacing=\"5\" cellpadding=\"5\">\n <thead>\n <tr style=\"font-weight:bold;background:gray\"> <td> Customer </td> <td> Product No </td> ";
                        $mailContent .= "<td> Product Serial </td> <td> Product Desc. </td><td> Product Qty. </td> <td> Warranty Expires on </td> </tr> </thead> <tbody>";
                        for($j=0;$j<sizeof($managerRecords);$j++)
                        {
                            
                            $row = "<tr>\n";
                            $row .= sprintf("<td> %s </td>",$managerRecords[$j]['custName']);
                            $row .= sprintf("<td> %s </td>",$managerRecords[$j]['prodNo']);
                            $row .= sprintf("<td> %s </td>",$managerRecords[$j]['prodSerial']);
                            $row .= sprintf("<td> %s </td>",$managerRecords[$j]['prodDesc']);
                            $row .= sprintf("<td> %s </td>",$managerRecords[$j]['prodQty']);
                            $row .= sprintf("<td> %s </td>",$managerRecords[$j]['expDate']);
                            $row .= "<tr>";   
                            $mailContent .= $row;                         
                        }
                        $mailContent.= "</tbody></table>";
                        echo $managers[$i]['acMan'] ."," . $managers[$i]['Email'] . "<br>";
                        echo $mailContent . "<br>";
                    }
                    else
                    {

                    }
                    
                }
                // = getManagerWarrantyRecords();
            }
            else
            {

            }
            /*
            $mangerArr = json_decode($managers,TRUE);
            //print_r($mangerArr);
            //echo "<br>";
            for($i=0;$i<sizeof($mangerArr);$i++)
            {
                //echo $i."<br>";
                $products = "";
                try 
                { 
                    
                    $iquery = sprintf("SELECT custName,prodNo,prodSerial,prodDesc,prodQty,expDate FROM wdbt.vw5days WHERE acMan='%s'",$mangerArr[$i]['acMan']);
                    //echo $iquery . "<br>";
                    $config  = array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES => false);
                    $con = new PDO("mysql:host=localhost; dbname = wdbt;charset=utf8", "root" ,"root" ,$config);
                    $stmt = $con->prepare($iquery);
                    $stmt->execute();
                   // echo "row count :" . $stmt->rowCount() . "<br>";
                    if($stmt->rowCount()>0)
                    {
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        $products = json_encode($result);
                        //echo $products . "<br>";
                        $productArr = json_decode($products,TRUE);
                        $tb = "<table border=\"1\" cellspacing=\"5\" cellpadding=\"5\">\n <thead>\n <tr style=\"font-weight:bold;background:gray\"> <td> Customer </td> <td> Product No </td> ";
                        $tb .= "<td> Product Serial </td> <td> Product Desc. </td><td> Product Qty. </td> <td> Warranty Expires on </td> </tr> </thead> <tbody>";
                        for($j=0; $j<sizeof($productArr);$j++)
                        {
                            $row = "<tr>\n";
                            $row .= sprintf("<td> %s </td>",$productArr[$j]['custName']);
                            $row .= sprintf("<td> %s </td>",$productArr[$j]['prodNo']);
                            $row .= sprintf("<td> %s </td>",$productArr[$j]['prodSerial']);
                            $row .= sprintf("<td> %s </td>",$productArr[$j]['prodDesc']);
                            $row .= sprintf("<td> %s </td>",$productArr[$j]['prodQty']);
                            $row .= sprintf("<td> %s </td>",$productArr[$j]['expDate']);
                            $row .= "<tr>";
                            $tb .= $row;
                        }
                        $tb.= "</tbody></table>";
                        echo $tb;
                    }
                    else
                    {
                        //$msg = $this->generateResponse(TRUE, $this->messages['nrf'], FALSE);
                        //return $msg;
                        echo "No records found.";
                    }
                }
                catch(PDOException $e)
                {
                    //$msg = $this->generateResponse(TRUE, $e->getMessage(),TRUE);
                    //return $msg;
                    echo $e->getMessage()  . "<br>";
                }//catch           
            }  */    

?>