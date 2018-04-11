<?php

function getDatabaseConnection($dbName)
{
    $host = "localhost";
    $dbname = $dbName;
    $username = "root";
    $password = "";
    $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    
    
    
 return $dbConn;
}

 ?>