<?php

    include "../dbConnection.php";
    
    $dbConn = getDatabaseConnection('finalProject');
    
    $productId = $_GET['productID'];
    
    $sql = "SELECT MAX(cost), name 
            FROM `fp_products` WHERE 1
            ";
    
    $stmt = $dbConn->prepare($sql);
    $stmt->execute(array(":productID" => $productId));
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    
    echo json_encode($record);

?>