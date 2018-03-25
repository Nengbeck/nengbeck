<?php
    session_start();
    include 'functions.php';
    
    if(isset($_POST['removeId']))
    {
        foreach ($_SESSION['cart'] as $itemKey => $item)
        {
            if($item['id'] == $_POST['removeId'])
            {
                unset($_SESSION['cart'][$itemKey]);
            }
        }
    }
    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = array();
    }
    
    if(isset($_GET['query']))
    {
        include 'wmapi.php';
        $items = getProducts($_Get['query']);
    }

    if(isset($_POST['itemName']))
    {
        $newItem = array();
        $newItem['name'] = $_POST['itemName'];
        $newItem['price'] = $_POST['itemPrice'];
        $newItem['img'] = $_POST['itemImg'];
        $newItem['id'] = $_POST['itemId'];
        
        foreach ($_SESSION['cart'] as &$item)
        {
            if($newItem['id'] == $item['id'])
            {
                $item['quantity'] += 1;
                $found = true;
            }
        }
        
        if($found != true)
        {
            $newItem['quantity'] = 1;
            array_push($_SESSION['cart'], $newItem);
        }
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <title>Shopping Cart</title>
    </head>
    <body>
        <div class='container'>
            <div class='text-center'>
                
                <!-- Bootstrap Navagation Bar -->
                <nav class='navbar navbar-default - navbar-fixed-top'>
                    <div class='container-fluid'>
                        <div class='navbar-header'>
                            <a class='navbar-brand' href='#'>Shopping Land</a>
                        </div>
                        <ul class='nav navbar-nav'>
                            <li><a href='index.php'>Home</a></li>
                            <li><a href='scart.php'>Cart</a></li>
                        </ul>
                    </div>
                </nav>
                <br /> <br /> <br />
                <h2>Shopping Cart</h2>
                <!-- Cart Items -->
                <?php
                if(isset($_SESSION['cart'])){
                    echo $_SESSION['cart'];
                }
                
                ?>
            </div>
        </div>
    </body>
</html>