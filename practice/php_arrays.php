 <?php

 $cards = array("ace","one", 2);
 //print_r($cards); // for debugging purposes, shows all elements in array.

 //echo $cards[0];
 
 $cards[] = "jack"; //adding a new elemnt at the end of the array
 array_push($cards, "queen");//adds queen to the end of the array.
 array_push($cards, "king", "ACE");
 print_r($cards); //prints the entire array.

 $cards[2] = "ten";
 
 print_r($cards);
 

 function displayCard()
 {
      echo "<img src=../labs/lab2/img/csumb_logo.jpg";
 }
 
 //unset($cards[1]);
 //unset removes an element
 
 //shuffle($cards); // randomizes the indexes of an array.
 
 
 
 
 ?>


<!DOCTYPE html>
<html>
    <head>
        <title> </title>
    </head>
    <body>

    </body>
</html>