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
    $sql="SELECT * FROM fp_products";
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
            #body{
                background-color:silver;
            }
            
        </style>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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
    <body id="body">

        <div class="w3-container w3-black">
        <h1><font color="green" class="col-md-4 col-md-offset-4">NTE's Product Protector</font> </h1>
        </div>
        <h3><font color="green" class="col-md-4 col-md-offset-5"><u>Control Center</u></font></h3>
        
        <br><br><br>
        
        
        <div class=class="col-md-5-md-offset-9">
        
        <form action="addProduct.php" class="col-md-5-md-offset-9">
            <button type="submit" class="btn btn-primary" value="Add Product">Add Product</button>
       </form>
       
       <div class="col-md-4 col-md-offset-4">
        <strong id = "strong"> <style> #strong{color:green;}</style><bold><u>Current Inventory : </u></bold></strong> <br>
        <?php $records=displayAllProducts();
            foreach($records as $record) {
                //echo "[<a href='updateProduct.php?productID=".$record['productID']."'>Update</a>]" . " " ;
                echo  "<br>" . $record["name"] . "<br>";
                echo  " Quantity: " . $record['quantity'] . "<br>";  
                echo  "Cost: " . "$" . $record["cost"] . "<br>";
                
                echo "<form action='updateProduct.php'>";
                echo "<input type='hidden' name='productID' value='" . $record['productID'] . "' />";
                echo "<input type='submit' class='btn btn-warning' value='Update'>" . " ";
                echo "</form>";
                
                echo "<form action='deleteProduct.php' onsubmit='return confirmDelete()'>";
                echo "<input type='hidden' name='productID' value='" . $record['productID'] . "' />";
                echo "<input type='submit' class = 'btn btn-secondary' value='Remove'>" . " ";
                
                echo "</form><br>";
            }
        
        ?>
       
        </div>
       
        <br><br>
        
        
        <form action="logout.php" class="col-md-5-md-offset-9">
            <!-- <input type="submit" value="log Out"/> -->
            <button type="submit" class="btn btn-danger" value="log Out">Log Out</button>
        </form>
        <br><br>
            <br><br>
            <p><strong><style>p{color:green; }</style><u>Aggregate Functions</u></strong></p>
            <button id="productCount"class="btn btn-info"> 
            Number of Products Owned
            </button>
            <br><br>
            <button id="average"class="btn btn-info">
            Average Cost
            </button>
            <br><br>
            <button id="categories"class="btn btn-info">
            Available Categories
            </button>
            <br><br>
            <!--<button id="mostExpensive"class="btn btn-info">
            Most Expensive
            </button>-->
        <br>
        
        </div>
        
        
        <br>
        
        <script>
            
            $(document).ready(function() {
                
                $("#average").click(function() {
                    $.ajax({
                        type: "GET",
                        url: "api/averageCostAPI.php",
                        data: {},
                        success: function(data){
                            alert("Average product value: $" + JSON.parse(data).average);
                        }
                    });
                }); 
                
                $("#productCount").click(function() {
                    $.ajax({
                        type: "GET",
                        url: "api/productTotalAPI.php",
                        data: {},
                        success: function(data){
                            alert("Products Owned: " + JSON.parse(data).total);
                        }
                    });
                }); 
                
                $("#categories").click(function() {
                    $.ajax({
                        type: "GET",
                        url: "api/categoriesAPI.php",
                        data: {},
                        success: function(data){
                            alert("Categories available: \n\n" + JSON.parse(data)[0].catName + '\n' + JSON.parse(data)[1].catName + '\n' + JSON.parse(data)[2].catName  );
                        }
                    });
                });
                
               /* $("#mostExpensive").click(function() {
                    $.ajax({
                        type: "GET",
                        url: "api/mostExpensiveProductAPI.php",
                        data: {},
                        success: function(data){
                            alert(JSON.parse(data).price);
                            alert("Most expensive product: " + JSON.parse(data).name +  "\nPrice: $" + JSON.parse(data).price);
                        }
                    });
                });*/
                
            }); 
        
        </script>
        
        
        
        

    </body>
</html>