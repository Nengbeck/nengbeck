<?php

    function getDatabaseConnection($dbName) {

         $host = "localhost";
         $dbname = $dbName;
         $username = "root";
         $password = "";
         
         //checks whether the URL contains "herokuapp" (using Heroku)
         if(strpos($_SERVER['HTTP_HOST'], 'herokuapp') !== false) {
            $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
            $host = $url["us-cdbr-iron-east-05.cleardb.net"];
            $dbname = substr($url["heroku_c3a87e9274bc026"], 1);
            $username = $url["b02d4fafa2c107"];
            $password = $url["95ca9032"];
        }
         
         $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
         $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
     
     return $dbConn;
     
    }
     
?>