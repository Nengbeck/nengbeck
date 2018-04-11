<?php

session_start();

$_SESSION['numToGuess'];
$_SESSION['numOfTries'] = 0;
$numToGuess = "";


function randomNumber()
{
    return rand(1,100);
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title> </title>
    </head>
    <body>
    <h1> Guess a Number between 1 and 100!</h1>
    
    <form method="get" action="April_9_2018.php">
        Guess: <input type="text" name="guess" value="">
      <br><br>
      <input type="Submit" name="guess Number" value="Guess Number" />
      <br><br>
      <input type="Submit" name="giveUp" value="give Up" />
      <input type="Submit" name="playAgain" value="play Again" />
    </form>
    
    <br><br><br>
    
    
    
    <?php
    
    if(!isset($_SESSION['numToGuess']))
    {
        $numToGuess = rand(1, 100);
        $_SESSION['numToGuess'] = $numToGuess;
    }
    
    if(isset($_SESSION['numToGuess']))
    {
        $numToGuess = $_SESSION['numToGuess'];
    }
    
    if(isset($_GET['giveUp']))
    {
        echo "Guess!";
        echo $numToGuess . "<br>";
    }
    
    if(isset($_GET['playAgain']))
    {
        $_SESSION['numOfTries'] = 0;
        $numToGuess = rand(1, 100);
        $_SESSION['numToGuess'] = $numToGuess;
    }
   
         if($_GET['guess'] == NULL)
           {
               session_destroy();
           }
    
        if($_GET['guess'] == $numToGuess)       //user wins
        {
            echo "You've guessed The number!";
        }   
                                    
           else{
            
            if($_GET['guess'] < $numToGuess && $_GET['guess'] != NULL)
            {
                echo "You guessed " .$_GET['guess'];
                echo "go higher!";
                $_SESSION['numOfTries'] ++;
                
            }
            
            else if ($_GET['guess'] > $numToGuess && $_GET['guess'] != NULL)
            {
                echo "You guessed " .$_GET['guess'];
                echo "go lower";
                $_SESSION['numOfTries'] ++;
            }
            
            echo "Number Of Tries: " . $_SESSION['numOfTries'] . "<br>";
            }
        //need to add the history    
    
    
    ?>
    
    
        
    </body>
</html>