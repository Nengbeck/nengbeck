<?php
  function getDatabaseConnection()
  {
      
      $host = "us-cdbr-iron-east-05.cleardb.net";
      $username = "b55ad801841dd3";
      $password = "a640cafb";
      $dbname= "heroku_34a8e5c8c0df63e";
  
  // Create connection
      $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
      return $conn;
      
    }
    
    function getProducts($page,$sql) {
       global $namedParameters;
       $dbConn = getDatabaseConnection();
       
       $stmt = $dbConn->prepare($sql);
       $stmt->execute($namedParameters);
       $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $items;
    }
?>