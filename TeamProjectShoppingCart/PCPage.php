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
           @import url("css/styles.css");
       </style>
         <link href="https://fonts.googleapis.com/css?family=Press+Start+2P" rel="stylesheet">
    </head>
    <body class="pc">
        <div class="container">
            <h1>PC</h1>
            <div class="formDiv">
                <h3>Search by:</h3>
                <form >
                    Title: <input type="text" name="title" placeholder="Enter game title" /><br/><br/>
                    <select id="dropdown" name="filter">
                        <option value="">Filter by...</option>
                        <option value="pc_title">Title</option>
                        <option value="pc_genre">Genre</option>
                        <option value="pc_price">Price</option>
                        <option value="pc_rating">Rating</option>
                    </select>
                    <br><br/>
                    
                    Price:  From <input type="text" name="priceFrom"/>
                    To   <input type="text" name="priceTo"/>
                    <br/><br/>
                    
                    <input type="radio" name="order" value="ASC">Asc
                    <input type="radio" name="order" value="DESC">Desc
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
                    
                    $sql = "SELECT * FROM pc WHERE 1";
                    
                    if(isset($_GET['submit'])){
                        
                        if(!empty($_GET['title'])) {
                            
                            $sql .= " AND pc_title LIKE '%" . $_GET['title'] . "%'";
                        }
                        
                        if(!empty($_GET['priceFrom'])) {
                            
                            $sql .= " AND pc_price >= " . $_GET['priceFrom'];
                        }
                        
                        if(!empty($_GET['priceTo'])) {
                            
                            $sql .= " AND pc_price <= " . $_GET['priceTo'];
                        }
                        
                        if(!empty($_GET['filter']))
                        {
                            $sql .= " ORDER BY " . $_GET['filter'];
                        }
                        
                        else {
                            $sql .= " ORDER BY pc_title";
                        }
                        
                        if(isset($_GET['order']))
                        {
                            $sql .= " " . $_GET['order'];
                        }
                    }
                    else{
                        $sql .= " ORDER BY pc_title";
                    }
                    
                    echo "<div id='tb3'>";
                    echo "<table id='fixed'>";
                    echo "<tr>";
                    
                    $items = getProducts("pc", $sql);
                    displayResults("pc");
                    
                    echo "</tr>";
                    
                    
                    echo "</table>";
                    
                ?>
            </div>
        </div>
    <script>
    var acc = document.getElementsByClassName("accordion");
    var i;
    
    for (i = 0; i < acc.length; i++) {
        acc[i].onclick = function(){
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }
        }
    }
    </script>
    </body>
</html>

