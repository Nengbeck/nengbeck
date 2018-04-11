<?php
    
    function displayResults($page) {
        
        global $items;
        
        if(isset($items)) {
            
            if(empty($items)) {
                
                echo "<h4>No results found.</h4>";
            }
            
            echo "<table class='table' >";
            
            foreach ($items as $item) {
                
                $itemName = $item[$page.'_title'];
                $itemDescription = $item[$page.'_description'];
                $itemPrice = $item[$page.'_price'];
                $itemPlatform = $item[$page.'_platform'];
                $itemGenre = $item[$page.'_genre'];
                $itemRating = $item[$page.'_rating'];
                $itemImage = $item[$page.'_image'];
                $itemId = $item[$page.'_id'];
                
                echo "<tr>";
                echo "<td><img src='$itemImage' width='250' height='300'></td>";
                echo "<td><button class='accordion' > $itemName</button>";
                echo "<div class='panel'>";
                        
                        echo "<h4>Summary:</h4>";
                        echo "<p id='description'>";
                        echo $itemDescription;
                        echo "</br >";
                        echo "<h4>Genre:</h4>";
                        echo $itemGenre;
                        echo "</br >";
                        if($page == "console" || $page == "mobile") {
                            
                            echo "<h4>Platform:</h4>";
                            echo $itemPlatform;
                            echo "</br>";
                        }
                        echo "<h4>Rating:</h4>";
                        echo $itemRating;
                        echo "</div>";
                echo "<td><h4>Price: </h4> $itemPrice</td>";
                
                echo "<form method='post'>";
                echo "<input type='hidden' name='itemName' value='$itemName'>";
                echo "<input type='hidden' name='itemId' value='$itemId'>";
                echo "<input type='hidden' name='itemImage' value='$itemImage'>";
                echo "<input type='hidden' name='itemPrice' value='$itemPrice'>";
                
                if($_POST['itemId'] == $itemId) {
                    
                    echo "<td><button id='buttonAdded' class='btn btn-warning'>Added</button></td>";
                }
                else {
                    echo "<td><button id='buttonAdd' class='btn btn-warning' >Add</button></td>";
                }
                
                echo "</form>";
                
                echo "</tr>";
            }
            
            echo "</table>";
        }
        
    }
    
    function displayCart() {
        
        if(isset($_SESSION['cart'])) {
            
            echo "<table class='table'>";
            foreach($_SESSION['cart'] as $item) {
                
                $itemName = $item['name'];
                $itemPrice = $item['price'];
                $itemImage = $item['image'];
                $itemId = $item['id'];
                $itemQuant = $item['quantity'];
                
                echo "<tr>";
                echo "<td><img src='$itemImage' width='250' height='300'></td>";
                echo "<td><h4>$itemName</h4></td>";
                echo "<td><h4>$itemPrice</h4></td>";
                
                echo "<form method='post'>";
                echo "<input type='hidden' name='itemId' value='$itemId'>";
                echo "<td><input type='text' name='update' class='form-control' placeHolder='$itemQuant'></td>";
                echo "<td><button class='btn btn-danger'>Update</button></td>";
                echo "</form>";
                
                echo "<form method='post'>";
                echo "<input type='hidden' name='removeId' value='$itemId'>";
                echo "<td><button class='btn btn-danger'>Remove</button></td>";
                echo "</form>";
                
                echo "</tr>";
            }
            
            echo "</table>";
        }
    }
    
    function displayCartCount() {
        
        echo count($_SESSION['cart']);
    }
?>