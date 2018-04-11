<?php

session_start();

include 'dbConnection.php';
$conn = getDatabaseConnection("guesses History");

$_SESSION['numToGuess'];
$_SESSION['numOfTries'] = 0;
$_SESSION['oldNumber'] = 0;
$_SESSION['tottries'] = 0;
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
            
            $_SESSION['oldNumber'] = $_SESSION['numToGuess'];
            $_SESSION['tottries'] = $_SESSION['numOfTries'];
            //echo "It  "$_SESSION['numToGuess'];
            /*//add number of tries
            //add the actual to guess
            
            $sql="SELECT * FROM om_product";
            $statement = $conn->prepare($sql);
            $statement->execute();
            $records = $statement->fetchAll(PDO::FETCH_ASSOC);*/
            
        }   
                                    
           else{
            
            if($_GET['guess'] < $numToGuess && $_GET['guess'] != NULL)
            {
                echo "You guessed " . $_GET['guess'];
                echo "<br>";
                echo " go higher! ";
                $_SESSION['numOfTries'] ++;
                echo "<br>";
            }
            
            else if ($_GET['guess'] > $numToGuess && $_GET['guess'] != NULL)
            {
                echo "You guessed " .$_GET['guess'];
                echo "<br>";
                echo " go lower ";
                $_SESSION['numOfTries'] ++;
                echo "<br>";
            }
             echo "<br><br><br>";
            echo "Number Of Tries: " . $_SESSION['numOfTries'] . "<br>";
            }
        
    echo "Guesses History";
    echo "you guessed the number " . $_SESSION['oldNumber'] . " in " . $_SESSION['numOfTries'];
    
    ?>
    
    
        
    </body>
</html>