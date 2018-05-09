<?php

session_start();

include 'dbConnection.php';
$conn = getDatabaseConnection("finalProject");


function displayAllProducts(){
    global $conn;
    $sql="SELECT name,cost, quantity FROM fp_products";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $records = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    return $records;
    
}


///////////////////////////////////////////
///////////////////////////////////////////
///////////////////////////////////////////

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
    
    
    function displaySearchResults()
    {
        global $conn;
        
        if (isset($_GET['searchForm'])) { //checks whether user has submitted the form
            
            echo "<h3 id='h3'> <u>Search Results: </u></h3>"; 
            
            $namedParameters = array();
          
            $sql = "SELECT * FROM fp_products WHERE 1";
            
            if (!empty($_GET['product'])) { //checks whether user has typed something in the "Product" text box
                 $sql .=  " AND name LIKE :name";
                 $namedParameters[":name"] = "%" . $_GET['product'] . "%";
            }
            
              
             if (!empty($_GET['category'])) { //checks whether user has typed something in the "Product" text box
                 $sql .=  " AND catID = :catID";
                 $namedParameters[":catID"] =  $_GET['category'];
             }    
             

            
             if (!empty($_GET['priceFrom'])) { //checks whether user has typed something in the "Product" text box
                 $sql .=  " AND cost >= :priceFrom";
                 $namedParameters[":priceFrom"] =  $_GET['priceFrom'];
             }
             
            if (!empty($_GET['priceTo'])) { //checks whether user has typed something in the "Product" text box
                 $sql .=  " AND cost <= :priceTo";
                 $namedParameters[":priceTo"] =  $_GET['priceTo'];
             }
            
             if (isset($_GET['orderByName'])) 
             {
                 if(!isset($_GET['orderByPrice']))
                 {
                     $sql .= " ORDER BY name";
                 }
                 
             }
             
              if (isset($_GET['orderByPrice'])) 
              {
                if(!isset($_GET['orderByName']))
                   $sql .= " ORDER BY cost";
              }
       
             $stmt = $conn->prepare($sql);
             $stmt->execute($namedParameters);
             $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(empty($records))
            {
                echo "<h4> No product found </h4>";
            }
            else
            {
                foreach ($records as $record) {
                
                    echo  $record["name"] . "<br>";
                    echo  " Quantity: " . $record['quantity'] . "<br>";  
                    echo  "Cost: " . "$" . $record["cost"] . "<br><br>";
                }
            }
        }
        
    }

?>



<!DOCTYPE html>
<html>
    <head>
        <title>Main Page</title>
        <style>
            
            form {
                display: inline;
            }
            #body{
                background-color:silver;
            }
            #formDiv{
                color:green;
            }
            #h3{
                color:green;
            }
            
        </style>
        
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="css/styles.css" rel="stylesheet" type="text/css" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
    <div class="w3-container w3-black">
        <h1><font color="green" class="col-md-4 col-md-offset-4">NTE's Product Protector</font> </h1>
        </div>
        <h3><font color="green" class="col-md-4 col-md-offset-5"><u>Control Center</u></font></h3>
        
        <form action="adminLogin.php" class="col-md-4-md-offset-5">
            <button type="submit" class="btn btn-success" value="login">Admin Login</button>
        </form>
        </div>
        
    </head>
    <body id="body">
        <br><br>
        
        <form id = "formDiv"class = "col-md-4 col-md-offset-4">
            <br><br>
            Product: <input type="text" name="product" />
            <br><br>
            Category: 
                <select name="category">
                    <option value=""> Select One </option>
                    <?=displayCategories()?>
                </select>
            <br><br>
            
            Price:  From <input type="text" name="priceFrom" size="7" />
                    To   <input type="text" name="priceTo" size="7" />
                   
            <br><br>
            
            Order result by: 
            <br>
            
            <input type="radio" name="orderByPrice" value="price"/> Price <br>
            <input type="radio" name="orderByName" value="name"/> Name
            
            <br><br>
            <input type="submit" value="Search" name="searchForm" />
            
        </form>
        
        <br><br>
        <br><br>
        
        <div class="col-md-3 col-md-offset-4">
            <br><br>
        <h3 id="h3"> <u>Current Inventory: </u></h3> 
        
        <?php $records=displayAllProducts();
            foreach($records as $record) {
                
                echo  $record["name"] . "<br>";
                echo  " Quantity: " . $record['quantity'] . "<br>";  
                echo  "Cost: " . "$" . $record["cost"] . "<br><br>";
            }
        
        ?>
        </div>
        <br><br><br><br><br><br><br><br><br><br><br><br>
        
        <?= displaySearchResults() ?>

    </body>
</html>