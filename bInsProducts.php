<?php
    $file = fopen("csv/products.csv","r");
    
    while (($csvData = fgetcsv($file, 10000, ",")) !== FALSE)
    {
        
        $query = sprintf("Insert into wdbt.tblProducts(prodNo,prodDesc) values('%s','%s')",$csvData[0],$csvData[1]);
//        echo $query."<br>";
        $config  = array( PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES => false);
        $con = new PDO("mysql:host=localhost;"." dname = wdbt"  ." ", "root" ,"root" ,$config);
        $stmt = $con->prepare($query);
        $stmt->execute();
    }
?>