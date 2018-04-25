<?php

include '../../dbConnection.php';

$conn = getDatabaseConnection("c9");

$username = $_GET['username'];
$password = $_GET['password'];
$fName = $_GET['fName'];
$lName = $_GET['lName'];
$zipcode = $_GET['zipcode'];
//next query allows for SQL injection because of the single quotes
//$sql = "SELECT * FROM lab9_user WHERE username = '$username'";

//$sql = "INSERT INTO lab9_user FROM lab9_user WHERE username = :username";
$sql = "INSERT INTO lab9_user
            ( `firstName`, `lastName`, `zipCode`, `userName`, `password`) 
             VALUES ( :fName, :lName, :zipcode, :username, :password)";

   $namedParameters = array();
    $namedParameters[':fName'] = $fName;
    $namedParameters[':lName'] = $lName;
    $namedParameters[':zipcode'] = $zipcode;
    $namedParameters[':username'] = $username;
    $namedParameters[':password'] = $password;

$stmt = $conn->prepare($sql);
$stmt->execute($namedParemeters);


?>