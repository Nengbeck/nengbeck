<?php
    
    session_start();
    
    include 'functions.php';
    include 'database.php';
    
    if(isset($_POST['itemName'])) {
        
        $newItem = array();
        $newItem['name'] = $_POST['itemName'];
        $newItem['id'] = $_POST['itemId'];
        $newItem['price'] = $_POST['itemPrice'];
        $newItem['image'] = $_POST['itemImage'];
        
        foreach($_SESSION['cart'] as &$item) {
            
            if($newItem['id'] == $item['id']) {
                
                $item['quantity'] += 1;
                $found = true;
            }
        }
        
        if($found != true) {
            
            $newItem['quantity'] = 1;
            array_push($_SESSION['cart'], $newItem);
        }
        
    }


?>
<html>
    <head>
        <style>
            @import url(css/styles.css);
        </style>
        <link href="https://fonts.googleapis.com/css?family=Press+Start+2P" rel="stylesheet">
    </head>
    <body class="console">
        <div class="container">
            <h1> Console </h1>
            <br>
           
            <div class="formDiv">
                <h3>Search by:</h3>
                <form >
                    Title: <input type="text" name="product" placeholder="Enter game title here" /><br/><br/>
                    <select id="dropdown" name="filter">
                        <option value="">Filter by...</option>
                        <option value="console_title">Title</option>
                        <option value="console_genre">Genre</option>
                        <option value="console_price">Price</option>
                        <option value="console_rating">Rating</option>
                    </select>
                    <br/><br/>
                    
                    Console Type: <input type="text" name="platform" placeholder="Enter console platform" />
                    <br/><br/>
                    
                    <strong>Price:  From</strong> <input type="text" name="priceFrom"/>
                    <strong>To</strong> <input type="text" name="priceTo"/>
                    <br/><br/>
                    
                    <input type="radio" name="order" value="ASC"><strong>Asc</strong>
                    <input type="radio" name="order" value="DESC"><strong>Desc</strong>
                    <br/><br/>
                    
                    <input type="submit" value="Search" name="submit">
                </form>
                
                <form action="CartPage.php">
                    <input type="submit" name="cart" value="Shopping Cart">
                </form>
                
                <form action="index.php">
                    <input type="submit" value="Back to home">
                </form>
            </div>
            
            <div class="textDiv">
                <?php
                
                    $sql = "SELECT * FROM console WHERE 1";
                    
                    if(isset($_GET['submit'])){
                        
                        if (!empty($_GET['product'])) 
                    { //checks whether user has typed something in the "Product" text box
                        $sql .=  " AND console_title LIKE :productName";
                        $namedParameters[":productName"] = "%" . $_GET['product'] . "%";
                    }
                        
                        if(!empty($_GET['platform'])) {
                            
                            $sql .= " AND console_platform LIKE '%" . $_GET['platform'] . "%'";
                        }
                        if(!empty($_GET['filter']))
                        {
                            $sql .= " ORDER BY " . $_GET['filter'];
                        }
                        if(empty($_GET['filter'])) {
                            $sql .= " ORDER BY console_title";
                        }
                        
                        if(isset($_GET['order']))
                        {
                            $sql .= " " . $_GET['order'];
                        }
                    }
                    else{
                        $sql .= " ORDER BY console_title";
                    }
                    
                    echo "<div id='tb'>";
                    echo "<table>";
                    echo "<tr>";
                    $items = getProducts("console", $sql);
                    displayResults("console");
                    
                    echo "</tr>";
                    
                    
                    echo "</table>";
                ?>
                
            </div>
        </div>
    <script>
    var acc = document.getElementsByClassName("accordion");
    var i;
    
    for (i = 0; i < acc.length; i++) 
    {
        acc[i].onclick = function()
        {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") 
            {
                panel.style.display = "none";
            }
            else 
            {
                panel.style.display = "block";
            }
        }
    }
    </script>
    </body>
</html>