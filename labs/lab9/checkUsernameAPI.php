<?php

/*include '../../dbConnection.php';

$conn = getDatabaseConnection("c9");

$username = $_GET['username'];

//next query allows for SQL injection because of the single quotes
//$sql = "SELECT * FROM lab9_user WHERE username = '$username'";

$sql = "SELECT * FROM lab9_user WHERE username = :username";
/*$sql = "SELECT * 
FROM lab9_user 
WHERE username = `username`";*/

/*!$stmt = $conn->prepare($sql);
$stmt->execute( array(":username"=>$username));
$record = $stmt->fetch(PDO::FETCH_ASSOC);

//print_r($record);

echo json_encode($record);*/

session_start();
$_SESSION['username'] = array();

$_SESSION['username'][0] = "bob";

$_SESSION['username'];

for($i = 0; $i < $_SESSION['username'].length(); $i++ )
{
    echo $_SESSION['username'][i];
}


?>