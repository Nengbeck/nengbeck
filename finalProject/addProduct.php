<?php
session_start();
if(!isset( $_SESSION['adminName']))
{
  header("Location:index.php");
}
include "dbConnection.php";
$conn = getDatabaseConnection("heroku_27d148a36beec91");

function displayCategories() {
        global $conn;
        
        $sql = "SELECT catID, catName FROM `fp_categories` ORDER BY catName";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        //print_r($records);
        
        foreach ($records as $record) {
            
            echo "<option value='".$record["catID"]."' >" . $record["catName"] . "</option>";
            
        }
        
    }

if (isset($_GET['submitProduct'])) {
    $productName = $_GET['name'];
    $quantity = $_GET['quantity'];
    $productPrice = $_GET['cost'];
    $category = $_GET['catID'];
    $owned = $_GET['owned'];
    
    $sql = "INSERT INTO `fp_products` 
            (name, quantity, cost, catID, owned) 
            VALUES (:name, :quantity, :cost, :catID, :owned)";
    
    $namedParameters = array();
    $namedParameters[':name'] = $productName;
    $namedParameters[':quantity'] = $quantity;
    $namedParameters[':cost'] = $productPrice;
    $namedParameters[':catID'] = $category;
    $namedParameters[':owned'] = $owned;
    $statement = $conn->prepare($sql);
    $statement->execute($namedParameters);
}

    if(isset($_GET['goBack']))
    {
        header("Location:admin.php");
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
     
        <script>
            
            function confirmIt() 
            {
                return confirm("Are you sure the information is correct?");
            }
            
        </script>
        <style>
            
            form {
                display: inline;
            }
            #body{
                background-color:silver;
            }
            #form{
                display: inline;
                color:green;
            }
            
        </style>
    </head>
    <body id="body">
        <div class="w3-container w3-black">
        <h1><font color="green">Add a product</font></h1>
        </div>
        <form id="form"class="col-md-4 col-md-offset-5">
            <br>
            Product name: <input type="text" name="name"><br><br>
            Quantity: <input name="quantity" ><br><br>
            Price: <input type="text" name="cost"><br><br>
            Owned: <input type="text" name="owned"><p>enter '0' for not owned, '1' for owned</p><br>
            Category: <select name="catID">
                <option value="">Select One</option>
                <?php displayCategories(); ?>
            </select> <br><br>
            <input class="btn btn-success"type="submit" name="submitProduct" value="Add Product"onclick="confirmIt()">
            
            <form action="admin.php">
                <input class="btn btn-warning"type="submit" name="goBack" value="Go Back">
            </form>
        </form>
    </body>
</html>