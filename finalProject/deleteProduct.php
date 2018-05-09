<?php
session_start();

    include 'dbConnection.php';
    $connection = getDatabaseConnection("finalProject");
    $sql = "DELETE FROM fp_products WHERE productID = " . $_GET['productID'];
    $statement = $connection->prepare($sql);
    $statement->execute(); 

    header("Location: admin.php");

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Delete Product</title>
        <meta charset="utf-8">
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
    </head>
    <body>

    </body>
</html>