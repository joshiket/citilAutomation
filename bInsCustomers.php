<?php
    $file = fopen("customers.csv","r");
    
    while (($custData = fgetcsv($file, 10000, ",")) !== FALSE)
    {
        
        $query = sprintf("Insert into wdbt.tblCustomers(custName) values('%s')",$custData[0]);
//        echo $query."<br>";
        $config  = array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES => false);
        $con = new PDO("mysql:host=localhost;"." dname = wdbt"  ." ", "root" ,"root" ,$config);
        $stmt = $con->prepare($query);
        $stmt->execute();
    }
?>