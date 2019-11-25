<?php
    function cleanData(&$str)
    {
        $str = preg_replace("/\t/", "\\t", $str);
        $str = preg_replace("/\r?\n/", "\\n", $str);
        if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
    }
    function generateResponse($error, $msg, $data)
    {
        $msgArr['error'] = $error;
        if($data)
            $msgArr['data'] = $msg;
        else
            $msgArr['msg'] = $msg;
        return json_encode($msgArr);
    } // generateResponse()    
    function getAllCertifications()
    {
        try 
        { 
            $query = "SELECT cProfName, cprovName, certiExam , certiExamDesc, certifiedOn, validTill, cerytiExpires, Expired FROM wdbt.vwcertifications";
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
    $msg = getAllCertifications();
    $certifications = json_decode($msg);
    //print_r($certifications);
    if(is_object($certifications))
    {
        if(!$certifications->error)
        {
            $certifications = $certifications->data;
            $certifications = json_decode($certifications,TRUE);
            //print_r($certifications);
            $filename = "certification_data" . ".xls";
            header("Content-Disposition: attachment; filename=\"$filename\"");
            header("Content-Type: application/vnd.ms-excel");
            $flag = false; // to render headers
            foreach($certifications as $row) {
                if(!$flag) {
                  // display field/column names as first row
                  echo implode("\t", array_keys($row)) . "\r\n";
                  $flag = true;
                }
                array_walk($row, __NAMESPACE__ . '\cleanData');
                echo implode("\t", array_values($row)) . "\r\n";
              }                        
        }
    }
    
?>