<?php

    include '../../dbConnection.php';
    $connection = getDatabaseConnection("heroku_27d148a36beec91");
    
    $sql = "DELETE FROM om_product WHERE productId = " . $_GET['productId'];
    
    $statement = $connection->prepare($sql);
    $statement->execute(); //commented out just for further development


    header("Location: admin.php");

?>


<!DOCTYPE html>
<html>
    <head>
        <title> </title>
    </head>
    <body>

    </body>
</html>