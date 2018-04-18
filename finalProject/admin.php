<?php

session_start();
if(!isset( $_SESSION['adminName']))
{
  header("Location:index.php");
}
include 'dbConnection.php';
$conn = getDatabaseConnection("heroku_27d148a36beec91");

function displayAllProducts(){
    global $conn;
    $sql="SELECT * FROM om_product";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $records = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    //print_r($records);

    return $records;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Admin Main Page</title>
        <style>
            
            form {
                display: inline;
            }
            
        </style>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="css/styles.css" rel="stylesheet" type="text/css" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
        <script>
            
            function confirmDelete() {
                
                return confirm("Are you sure you want to delete it?");
                
            }
            
        </script>
        
    </head>
    <body>


        <div class="w3-container w3-black">
        <h1><font color="green" class="col-md-4 col-md-offset-4">NTE's Product Protector</font> </h1>
        </div>
        <h3><font color="green" class="col-md-4 col-md-offset-5">Control Center</font></h3>
        
        </br><br>
        <div class="container">
            <form action="buySoon.php" class="col-md-4-md-offset-5">
            <button type="submit" class="btn btn-success" value="Add Product">Buy Soon</button>
        </form>
        <br><br>
        <form action="addProduct.php" class="col-md-5-md-offset-9">
            <button type="submit" class="btn btn-primary" value="Add Product">Add Product</button>
        </form>
        <br></br>
        <form action="logout.php"class="col-md-4 col-md-offset-11">
            <!-- <input type="submit" value="log Out"/> -->
            <button type="submit" class="btn btn-danger" value="log Out">Log Out</button>
        </form>
        <br><br>
        </div>
        <br />
        <div class="col-md-4 col-md-offset-4">
        <strong> Products: </strong> <br />
        
        <?php $records=displayAllProducts();
            foreach($records as $record) {
                echo "[<a href='updateProduct.php?productId=".$record['productId']."'>Update</a>]" . " " ;
                //echo "[<a href='deleteProduct.php?productId=".$record['productId']."'>Delete</a>]";
                
                echo "<form action='deleteProduct.php' onsubmit='return confirmDelete()'>";
                echo "<input type='hidden' name='productId' value= " . $record['productId'] . " />";
                echo "<input type='submit' value='Remove'>" . " ";
                echo "</form>";
                
                echo $record['productName'];
                echo '<br>';
                echo '<br>';
            }
        
        ?>
        </div>
        

    </body>
</html>