<?php

session_start();
    
    //checks if cart array is initialized yet.
    if(!isset($cartItemsArray))
    {
        #array to hold items
        $cartItemsArray = array();
        #add items to cart array.
        array_push($cartItemsArray, "apple", "raspberry","banana");
    }
    
    //checks if session variable has been set yet, if it hasn't, fill it with the array's values.
    if(!isset($_SESSION['cartItems']))
    {
        #create and set session variable to array.
    $_SESSION['cartItems'] = $cartItemsArray;
    }
    
    if(isset($addElement))
    {
       addToArray(); 
    }
    
   
   
            

#display cart items using array.
for($i = 0; $i < sizeof($cartItemsArray); $i++)
        {
          print_r($cartItemsArray[$i]);
          echo " array contents !!<br>";
        }
echo '<br>';




#prints out session variable.      
foreach($_SESSION['cartItems'] as $key=>$value)
    {
    echo $value.' Session variable values!! <br />';
    }
echo '<br>';  




$newArray = array(); #need to make a new array for each page. 
#put session variable values into new array ??
foreach($_SESSION['cartItems'] as $key=>$value)
    {
        echo "value's value !! ";
        array_push($newArray, $value);
        echo $newArray[$key]. " new array values!! <br>";
    }
echo '<br>';    
    
    
    
#delete everything from cart
    for($i = 0; $i < sizeof($newArray); $i++)
        {
          unset($newArray[$i]);
          echo " removing elements !!<br>";
        }
        
echo '<br>';

    for($i = 0; $i < sizeof($newArray); $i++)
        {
         echo $newArray[$i] . "Testing if empty... ";
        }




# Still trying to figure this part out...
function addToArray()
{
    array_push($newArray, "testVariable");
    echo "Added to array!";
}  

function emptyArray()
{
    for($i = 0; $i < sizeof($newArray); $i++)
        {
          unset($newArray[$i]);
          echo " removing elements !!<br>";
        }
}


?>

<!DOCTYPE html>
<html>
    <head>
        <title> </title>
    </head>
    <body>


        <!-- Can't get the function call right-->
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <button type="submit" name= "addElement" value="addElement" onclick="alert('adding value to array')">Add to cart!!</button>
            <br>
            <button type="button">Empty the cart!!</button>
            <br>
            <input type="submit" value="Submit">
        </form>
        
    </body>
</html>