<?php

function randColor()
{
    $backgroundColor;
    $colorNum = rand(1,4);
    switch($colorNum)
    {
        case 1: $backgroundColor = 1;
                break;
        case 2: $backgroundColor = 2;
                break;
        case 3: $backgroundColor = 3;
                break;
        case 4: $backgroundColor = 4;
                break;
    }

}

function displayArray()
{
    $counter = 0;
    $arrayNum = rand(3,10);
    $array = array();
    echo "Here's a Random Array!<br>";
    while($counter == 0){
        for($i = 0; $i < $arrayNum; $i++)
        {
          $array[$i] = Rand(1,99);
          print_r($array[$i]);
        }
       echo "<br>";
    $counter = 1;
    }
    echo "<br>";
    while($counter == 1){
        echo "Now it's Shuffled!<br>";
        shuffle($array);
        for($i = 0; $i < $arrayNum; $i++)
        {
          
          print_r($array[$i]);
        }
        echo "<br>";
        $counter = 2;
    }
    echo "<br>";
    while($counter == 2){
        echo " Now it's been Popped!!<br>";
        array_pop($array);
        $counter = 3;
    }
    for($i = 0; $i < $arrayNum; $i++)
    {
        print_r($array[$i]);
    }
    echo "<br>";
    echo "<br>";
    
    while($counter == 3){
        echo " Now Let's PUSH!!<br>";
        array_push($array," ''Niccolo'' " . "1125");
         for($i = 0; $i < $arrayNum; $i++)
        {
        print_r($array[$i]);
        }
        echo "<br>";
        echo "<br>";
        echo "That's an interesting new element in there... ;)<br>";
        $counter = 4;
    }
    echo "<br>";
    
   
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8" />
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
        <title>HW2</title>
        
    </head>
    
    <body>
    <nav>
        <a href="https://www.lamborghini.com/en-en/brand/masterpieces/aventador-superveloce" alt="lamborghini Aventador SV webpage">The Baddest Bull</a>
    </nav>
    
    <div>
    <?php
    displayArray();
    ?>
    </div>
    
    <img src="https://storage.googleapis.com/gtspirit/uploads/2015/11/Lamborghini-Murcielago-SV-2.jpg" alt="Lamborghini Murcielago LP-670-4 SV" width = 375px height = 275px class="center">
    <br> </br>
    <img src="https://hips.hearstapps.com/amv-prod-cad-assets.s3.amazonaws.com/images/17q1/674165/2018-lamborghini-huracan-performante-is-a-car-worth-waiting-for-feature-car-and-driver-photo-677160-s-original.jpg" width = 400px height = 250px class="center">   
    </body>
    <footer id="foot">
        <hr>
        CST336 Internet Programming. 2018&copy; Engbeck <br />
                    <br />
                    <br />
                    <img src="img/csumb_logo.jpg" alt="CSUMB Logo" height = 125, width = 200/>
            
        </footer>
</html>