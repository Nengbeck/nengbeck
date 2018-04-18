<?php

    function getDatabaseConnection($dbName) 
    {

        $host = "us-cdbr-iron-east-05.cleardb.net";
        $username = "b02d4fafa2c107";
        $password = "95ca9032";
        $dbname= "heroku_c3a87e9274bc026";
         
         //checks whether the URL contains "herokuapp" (using Heroku)
         if(strpos($_SERVER['HTTP_HOST'], 'herokuapp') !== false) 
         {
            $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
            $host = $url["host"];
            $dbname = substr($url["path"], 1);
            $username = $url["user"];
            $password = $url["pass"];
        }
         
         $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
         $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
     
     return $dbConn;
     
    }
     
?>