<?php

    include "../dbConnection.php";
    
    $dbConn = getDatabaseConnection('finalProject');
    
    $productId = $_GET['productID'];
    
    $sql = "SELECT catName, COUNT(catID) total 
            FROM fp_categories 
            WHERE 1 
            GROUP BY catName
            ";
    
    $stmt = $dbConn->prepare($sql);
    $stmt->execute(array(":productID" => $productId));
    $record = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($record);

?>