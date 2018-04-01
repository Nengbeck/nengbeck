<?php

session_start();

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Admin Main Page </title>
    </head>
    <body>


        
        <h1> Admin Main Page </h1>
        
        <h3> Welcome <?=$_SESSION['adminName']?>! </h3>
        
        <br />
        
        <strong> Products: </strong> <br />
        
        <?=displayAllProducts()?>
        
        

    </body>
</html>