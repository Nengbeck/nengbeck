<?php

    function getDatabaseConnection($dbName) 
    {

        $host = "us-cdbr-iron-east-05.cleardb.net";
         $dbname = "heroku_27d148a36beec91";
         $username = "ba8ca6e914b47a";
         $password = "df12719a";
         
         
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