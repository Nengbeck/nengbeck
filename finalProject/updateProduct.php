<?php
    include 'dbConnection.php';
    
    $connection = getDatabaseConnection("heroku_27d148a36beec91");
    
    function getCategories($catId) {
    global $connection;
    
    $sql = "SELECT catId, catName from om_category ORDER BY catName";
    
    $statement = $connection->prepare($sql);
    $statement->execute();
    $records = $statement->fetchAll(PDO::FETCH_ASSOC);
    /*foreach ($records as $record) {
        echo "<option  ";
        echo ($record["catId"] == $catId)? "selected": ""; 
        echo " value='".$record["catId"] ."'>". $record['catName'] ." </option>";
    }*/
}
    
    function getProductInfo()
    {
        global $connection;
        $sql = "SELECT * FROM om_product WHERE productId = " . $_GET['productId'];
    
        //echo $_GET["productId"];
        
        $statement = $connection->prepare($sql);
        $statement->execute();
        $record = $statement->fetch(PDO::FETCH_ASSOC);
        
        return $record;
    }
    
    
    if (isset($_GET['updateProduct'])) {
        
        //echo "Trying to update the product!";
        
        $sql = "UPDATE om_product
                SET productName = :productName,
                    productDescription = :productDescription,
                    productImage = :productImage,
                    price = :price,
                    catId = :catId
                WHERE productId = :productId";
        $np = array();
        $np[":productName"] = $_GET['productName'];
        $np[":productDescription"] = $_GET['description'];
        $np[":productImage"] = $_GET['productImage'];
        $np[":price"] = $_GET['price'];
        $np[":catId"] = $_GET['catId'];
        $np[":productId"] = $_GET['productId'];
                
        $statement = $connection->prepare($sql);
        $statement->execute($np);        

        
    }
    
    
    if(isset ($_GET['productId']))
    {
        $product = getProductInfo();
    }
    if(isset($_GET['goHome']))
    {
        header("Location:index.php");
    }
    
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Update Product </title>
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
        <h1><font color="green">Update Product</font></h1>
        </div>
        
        <form class="col-md-4 col-md-offset-4">
            <input type="hidden" name="productId" value= "<?=$product['productId']?>"/>
            Product name: <input type="text" value = "<?=$product['productName']?>" name="productName"><br>
            Description: <textarea name="description" cols = 50 rows = 4><?=$product['productDescription']?></textarea><br>
            Price: <input type="text" name="price" value = "<?=$product['price']?>"><br>
    
            Category: <select name="catId">
                <option>Select One</option>
                <?php getCategories( $product['catId'] ); ?>
            </select> <br />
            Set Image Url: <input type = "text" name = "productImage" value = "<?=$product['productImage']?>"><br>
            <input type="submit" name="updateProduct" value="Update Product">
            
            <form action="index.php">
                <input type="submit" name="goHome" value="Go Home">
            </form>
           
        </form>
    </body>
</html>