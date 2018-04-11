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
    <body class="mobileStyle">
        
        <div class="container">
            <h1>Mobile</h1>
            <div class="formDiv">
                <h2>Search by:</h2>
                <form >
                    
                    Title:
                    <input type="text" name="title" placeholder="Enter game title here"/>
                    <br/><br/>
                    
                    <select id="dropdown" name="filter">
                        <option value="">Filter by...</option>
                        <option value="mobile_title">Title</option>
                        <option value="mobile_genre">Genre</option>
                        <option value="mobile_rating">Rating</option>
                    </select>
                    <br/><br/>
                    
                    Mobile Platform: <input type="text" name="platform" placeholder="Enter mobile platform" />
                    </br></br>
                    
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
                    
                    $sql = "SELECT * FROM mobile WHERE 1";
                    
                    if(isset($_GET['submit'])){
                        
                        if(!empty($_GET['title'])) {
                            
                            $sql .= " AND mobile_title LIKE '%" . $_GET['title'] . "%'";
                        }
                        
                        if(!empty($_GET['platform'])) {
                            
                            $sql .= " AND mobile_platform LIKE '%" . $_GET['platform'] . "%'";
                        }
                        if(!empty($_GET['filter']))
                        {
                            $sql .= " ORDER BY " . $_GET['filter'];
                        }
                        else {
                            $sql .= " ORDER BY mobile_title";
                        }
                        
                        if(isset($_GET['order']))
                        {
                            $sql .= " " . $_GET['order'];
                        }
                    }
                    else{
                        $sql .= " ORDER BY mobile_title";
                    }
                    
                    
                    echo "<div id='play'>";
                    echo "<table>";
                    echo "<tr>";
                    
                     $items = getProducts("mobile", $sql);
                    displayResults("mobile");
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
