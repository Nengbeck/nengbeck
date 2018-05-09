<?php
session_start();
    include 'dbConnection.php';
    
    $connection = getDatabaseConnection("finalProject");
    
    function getCategories($catID) {
    global $connection;
    
    $sql = "SELECT catID, catName from fp_categories ORDER BY catName";
    
    $statement = $connection->prepare($sql);
    $statement->execute();
    $records = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($records as $record) 
    {
        echo "<option  ";
        echo ($record['catID'] == $catID)? "selected": ""; 
        echo " value='".$record['catID'] ."'>". $record['catName'] ." </option>";
    }
    
}
    
    function getProductInfo()
    {
        global $connection;
        $sql = "SELECT * 
        FROM fp_products 
        WHERE productID = " . $_GET['productID'];
    
        
        $statement = $connection->prepare($sql);
        $statement->execute();
        $record = $statement->fetch(PDO::FETCH_ASSOC);
        
        return $record;
    }
    
    if(isset ($_GET['productID']))
    {
        $product = getProductInfo();
    }
    if(isset($_GET['goHome']))
    {
        header("Location:admin.php");
    }
    
    if (isset($_GET['updateProduct'])) {
        
        
        $sql = "UPDATE fp_products
                SET name = :name,
                    quantity = :quantity,
                    cost = :cost,
                    owned = :owned,
                    catID = :catID,
                    productID = :productID
                WHERE productID = :productID";
        $np = array();
        $np[":name"] = $_GET['name'];
        $np[":quantity"] = $_GET['quantity'];
        $np[":cost"] = $_GET['cost'];
        $np [":owned"] = $_GET['owned'];
        $np[":catID"] = $_GET['catID'];
        $np[":productID"] = $_GET['productID'];
    
        $statement = $connection->prepare($sql);
        $statement->execute($np);        

        header("Location: admin.php");
    }
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Update Product </title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style>
            #form{
                color:green;
            }
            #body{
                background-color:silver;
            }
        </style>
    </head>
    <body id="body">
        <div class="w3-container w3-black">
        <h1><font color="green">Update Product</font></h1>
        </div>
        
        <form class="col-md-4 col-md-offset-4" id="form">
            <input type="hidden" name="productID" value= "<?=$product['productID']?>"/>
            <br>
            Product Name: <input type="text" value = "<?=$product['name']?>" name="name"><br><br>
            Quantity: <input name="quantity" value = "<?=$product['quantity']?>"><br><br>
            Price: <input type="text" name="cost" value = "<?=$product['cost']?>"><br><br>
            Owned: <input type="text" name="owned"value = "<?=$product['owned']?>"><p>enter '0' for not owned, '1' for owned</p><br>
            
            Category: <select name="catID">
                <option>Select One</option>
                <?php getCategories( $product['catID'] ); ?>
            </select> <br><br>
            <input type="submit"class="btn btn-success" name="updateProduct" value="Update Product">
            
        </form>   
            
        <form action="admin.php" class="col-md-4 col-md-offset-4">
            <br>
            <input class="btn btn-warning"type="submit" name="goHome" value="Go Home">
        </form>
           
        
    </body>
</html>