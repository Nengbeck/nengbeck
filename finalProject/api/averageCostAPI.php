<?php

    include "../dbConnection.php";
    
    $dbConn = getDatabaseConnection('finalProject');
    
    $productId = $_GET['productID'];
    
    $sql = "SELECT ROUND(AVG(cost),2) as average
            FROM fp_products
            ";
    
    $stmt = $dbConn->prepare($sql);
    $stmt->execute(array(":productID" => $productId));
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    
    echo json_encode($record);

?>