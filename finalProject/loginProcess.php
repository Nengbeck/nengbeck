<?php

    session_start();

    //print_r($_POST);  //displays values passed in the form
    
    include 'dbConnection.php';
    
    $conn = getDatabaseConnection("heroku_27d148a36beec91");
    
    $username = $_POST['username'];
    $password = sha1($_POST['password']);
    
    //echo $password;
    
    
    //following sql does not prevent SQL injection
    $sql = "SELECT * 
            FROM om_admin
            WHERE username = '$username'
            AND   password = '$password'";
            
    //following sql prevents sql injection by avoiding using single quotes        
    $sql = "SELECT * 
            FROM om_admin
            WHERE username = :username
            AND   password = :password";    
            
    $np = array();
    $np[":username"] = $username;
    $np[":password"] = $password;
    
            
    $stmt = $conn->prepare($sql);
    $stmt->execute($np);
    $record = $stmt->fetch(PDO::FETCH_ASSOC); //expecting one single record
    
    
    if (empty($record)) {
        
        echo " <div id='text'><br><br><strong>Wrong username or password!</strong>";
        
        if(isset($_GET['goHome']))
    {
        header("Location:index.php");
    }
        
    } else {
        
        
            //echo $record['firstName'] . " " . $record['lastName'];
            $_SESSION['adminName'] = $record['firstName'] . " " . $record['lastName'];
            header("Location:admin.php");
        
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Wrong Login information </title>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style>
            #loginForm{
                color:green;
            }
            #body{
                background-color:silver;
            }
            #text{
                text-align:center;
                color:green;
            }
            
            
        </style>
    </head>
    <body id="body">

<form id="loginForm"action="index.php">
    <br>
        <input type="submit" class="btn btn-warning" name="goHome" value="Go Home">
</form>
</body>