<?php

 $sql1 = "SELECT COUNT(1) totalPurchases
            FROM om_purchase p
            INNER JOIN om_user u
            on p.user_id = u.userId
            WHERE purchaseDate >= \"2018-02-01\" AND purchaseDate <= \"2018-02-29\"";
            
 $sql2 = "SELECT productName
            FROM om_user u
            INNER JOIN om_purchase p
            on u.userId = p.user_id
            NATURAL JOIN om_product
            WHERE email LIKE \"%@aol.com\" ";
            
 $sql3 = "SELECT SUM(quantity), sex
            FROM om_user u
            INNER JOIN om_purchase p
            on u.userId = p.user_id
            GROUP BY sex";

 $sql4 = "SELECT DISTINCT(catName)
            FROM om_purchase p
            INNER JOIN om_user u
            on p.user_id = u.userId
            NATURAL JOIN om_product 
            NATURAL JOIN om_category cat
            WHERE purchaseDate >= \"2018-02-01\" AND purchaseDate <= \"2018-02-29\"";
            
 
 $host = "localhost";
 $dbname = "ottermart";
 $username = "root";
 $password = "";
 $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
 $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
 
 $stmt = $dbConn->prepare($sql1);
 $stmt->execute();
 $records = $stmt->fetch();  //You are expecting ONLY ONE record
 
 //print_r($records);
 
 echo "Total Purchases in February: " . $records['totalPurchases'];
 
 
 $stmt = $dbConn->prepare($sql2);
 $stmt->execute();
 $records = $stmt->fetchAll(PDO::FETCH_ASSOC);  //You are expecting MANY records
 

 
 echo "<br/><br/>Products bought by users with an AOL account: <br />";
 
 foreach ($records as $record) {
  
     echo $record['productName']  . "<br />";
   
 }
 
 
 $stmt = $dbConn->prepare($sql3);
 $stmt->execute();
 $records = $stmt->fetchAll();

 ?>
 
 
 
