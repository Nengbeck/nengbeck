
<?php

    include '../../dbConnection.php';
   
    
    $conn = getDatabaseConnection("ottermart");

    function displayCategories(){
        global $conn;
        
        $sql = "SELECT catId, catName FROM `om_category` ORDER BY catName";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($records as $record) {
            
            echo "<option value='".$record["catId"]."' >" . $record["catName"] . "</option>";
            
        }
        
    }
    function orderResultByPrice() //not used, just trying things.
    {
        global $conn;
        
        $sql = "SELECT catId, price, productName 
                FROM `om_product` 
                ORDER BY price ASC";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($records as $record) {
            
            echo "<option value='".$record["productName"]."' >" . $record["price"] . "</option>";
            
        }
               
    }
    
    function orderResultByName() //not used, just trying things.
    {
         global $conn;
        
        $sql = "SELECT catId, price, productName 
                FROM `om_product` 
                ORDER BY productName ASC";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($records as $record) {
            
            echo "<option value='".$record["productName"]."' >" . $record["price"] . "</option>";
            
        }
         
    }
    
    
    
    function displaySearchResults(){
        global $conn;
        
        if (isset($_GET['searchForm'])) { //checks whether user has submitted the form
            
            echo "<h3>Products Found: </h3>"; 
            
            $namedParameters = array();
            
            $sql = "SELECT * FROM om_product WHERE 1";
            
            if (!empty($_GET['product'])) { //checks whether user has typed something in the "Product" text box
                 $sql .=  " AND productName LIKE :productName";
                 $namedParameters[":productName"] = "%" . $_GET['product'] . "%";
            }
                  
                  
             if (!empty($_GET['category'])) { //checks whether user has typed something in the "Product" text box
                 $sql .=  " AND catId = :categoryId";
                 $namedParameters[":categoryId"] =  $_GET['category'];
            }        
            
             if (!empty($_GET['priceFrom'])) { //checks whether user has typed something in the "Product" text box
                 $sql .=  " AND price >= :priceFrom";
                 $namedParameters[":priceFrom"] =  $_GET['priceFrom'];
            }        
            
             if (!empty($_GET['priceTo'])) { //checks whether user has typed something in the "Product" text box
                 $sql .=  " AND price <= :priceTo";
                 $namedParameters[":priceTo"] =  $_GET['priceTo'];
            }
            
            if (isset($_GET['orderBy'])) { //checks whether user has typed something in the "Product" text box
                 
                 if ($_GET['orderBy'] == "price")
                 {
                     $sql .= " ORDER BY price";
                 }
                 else {
                     {
                     $sql .= " ORDER BY productName";     
                     }
                 }
            }
            
            
             $stmt = $conn->prepare($sql);
             $stmt->execute($namedParameters);
             $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            foreach ($records as $record) {
            
                 echo  $record["productName"] . " " . $record["productDescription"] . " $" . $record["price"] . "<br><br />";
            
            }
        }
        
    }

    
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8" />
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <title> OtterMart Product Search </title>
    </head>
    <body>

        <h1>  OtterMart Product Search </h1>
        
        <form>
            
            Product: <input type="text" name="product" /><br />
            
            Category: 
                <select name="category">
                    <option value=""> Select One </option>
                    <?=displayCategories()?>
                </select>
            <br />
            
            Price:  From <input type="text" name="priceFrom" size="7"/>
                    To   <input type="text" name="priceTo" size="7"/>
                    
            <br />
            
             Order result by:<br />
             
             <input type="radio" name="orderBy" value="price"/> Price <br />
             <input type="radio" name="orderBy" value="name"/> Name
             
             <br />
             <input type="submit" value="Search" name="searchForm" />
             
        </form>
        
        <br />
        <hr>
        
        <?= displaySearchResults() ?>

    </body>
</html>