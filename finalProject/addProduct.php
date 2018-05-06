<?php
session_start();
if(!isset( $_SESSION['adminName']))
{
  header("Location:index.php");
}
include "dbConnection.php";
$conn = getDatabaseConnection("heroku_27d148a36beec91");

function getCategories() {
    global $conn;
    
    $sql = "SELECT catId, catName from om_category ORDER BY catName";
    
    $statement = $conn->prepare($sql);
    $statement->execute();
    $records = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($records as $record) {
        echo "<option value='".$record["catId"] ."'>". $record['catName'] ." </option>";
    }
}

if (isset($_GET['submitProduct'])) {
    $productName = $_GET['productName'];
    $productDescription = $_GET['description'];
    $productImage = $_GET['productImage'];
    $productPrice = $_GET['price'];
    $catId = $_GET['catId'];
    
    $sql = "INSERT INTO om_product
            ( `productName`, `productDescription`, `productImage`, `price`, `catId`) 
             VALUES ( :productName, :productDescription, :productImage, :price, :catId)";
    
    $namedParameters = array();
    $namedParameters[':productName'] = $productName;
    $namedParameters[':productDescription'] = $productDescription;
    $namedParameters[':productImage'] = $productImage;
    $namedParameters[':price'] = $productPrice;
    $namedParameters[':catId'] = $catId;
    $statement = $conn->prepare($sql);
    $statement->execute($namedParameters);
}

    if(isset($_GET['goHome']))
    {
        header("Location:index.php");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Add a product </title>
        <meta charset="utf-8">
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
     
    </head>
    <body>
        <div class="w3-container w3-black">
        <h1><font color="green">Add a product</font></h1>
        </div>
        <form class="col-md-4 col-md-offset-4">
            Product name: <input type="text" name="productName"><br>
            Description: <textarea name="description" cols = 50 rows = 4></textarea><br>
            Price: <input type="text" name="price"><br>
            Category: <select name="catId">
                <option value="">Select One</option>
                <?php getCategories(); ?>
            </select> <br />
            Set Image Url: <input type = "text" name = "productImage"><br>
            <input type="submit" name="submitProduct" value="Add Product">
            
            <form action="index.php">
                <input type="submit" name="goHome" value="Go Home">
            </form>
        </form>
    </body>
</html>