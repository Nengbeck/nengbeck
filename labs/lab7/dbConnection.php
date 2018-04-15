<?php

function getDatabaseConnection($dbName)
{
    $host = "us-cdbr-iron-east-05.cleardb.net";
    $dbname = "heroku_27d148a36beec91";
    $username = "b55ad801841dd3";
    $password = "a640cafbs";
    $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
 
 return $dbConn;
}

 ?>