<?php
    session_start();
    $_SESSION["timesAccessed"];
    $start = microtime(true);
    
    function displayHand($hand, $suit) {
        
        $points = 0;
        $count = count($hand);
        
        for($i = 0; $i < $count; $i++) {
            
          
            $cardvalue = ($suit[$i] % 13) + 1;

            
            if($suit[$i] <= 13) {
                $cardSuit = "clubs";
              
            }
            elseif($suit[$i] > 13 && $suit[$i] <= 26) {
                $cardSuit = "diamonds";
                
            }
            elseif($suit[$i] > 26 && $suit[$i] <= 39) {
                $cardSuit = "hearts";
                
            }
            else {
                $cardSuit = "spades";
                
            }
            $points += ($suit[$i] % 13) + 1;
            echo "<img src='./img/cards/$cardSuit/$cardvalue.png' alt=' Card: $cardSuit $cardvalue' />" ;
        }
        echo "<div class=\"try\">
              <h3 id=\"score\">Score: $points</h3>
        </div>";
    }
     
     $hands = array();
     $suits = array();
     $players = array(array("name" => "Wonder Woman", "linkToImage" => "img/wonderWoman.png"), 
                     array("name" => "The Flash", "linkToImage" => "img/flash.png"), 
                     array("name" => "Superman", "linkToImage" => "img/superman.png"), 
                     array("name" => "Batman", "linkToImage" => "img/batman.png"));
                     
    shuffle($players);
    $cards = array();
    
    // add cards to our deck
    for($i = 0; $i < 52; $i++) {
        array_push($cards,$i);
    }
    
    // so we don't repeat cards
    shuffle($cards);
    $index = 0;
    
     
     // 4 times because we have 4 players
     for($i = 0; $i < 4; $i++) {
         
         // how many cards current player will get
        $numCards = 10;
        $playerHand = array();
        $suitValues = array();
        
        for($j = 0; $j < $numCards; $j++) {
            
            $suit = $cards[$index];
            $cardvalue = ($cards[$index] % 13) + 1;
            array_push($playerHand,$cardvalue);
            array_push($suitValues,$suit);
            $index += 1;
            if(array_sum ($playerHand) >= 36 && array_sum($playerHand) <= 42)
            {
                break;
            }
            if(array_sum($playerHand) > 42)
            {
                break;
            }
        }
        
        array_push($hands, $playerHand);
        array_push($suits, $suitValues);
    }
    
    
function displayWinner($hands,$players) {
    $scores= array();
    for($i = 0; $i < 4; $i++) {
       
       $score = array_sum($hands[$i]);
        
        array_push($scores,$score);
        $score = 0;
    }
    
    $maxScore;
    $occurences = 0;
    $index = 0;
    $indexTie1;
    $indexTie2;
    $indexTie3;
    $winnerPoints = 0;
    
    for($j = 0; $j < 4; $j++) {
        
        if($scores[$j] == $maxScore && $occurences == 0) {
            
            $occurences++;
            $indexTie1 = $j;
        }
        
        else if($scores[$j] == $maxScore && $occurences == 1) {
            
            $occurences++;
            $indexTie2 = $j;
        }
        
        else if($scores[$j] == $maxScore && $occurences == 2) {
            
            $occurences++;
            $indexTie3 = $j;
        }
        
       if($scores[$j]<=42 && $scores[$j]>$maxScore)
            {
               $maxScore = $scores[$j];
               $index = $j;
            }
    }
        
    for($i = 0; $i < 4; $i++) {
        
        if($scores[$i] != $maxScore) {
            
            $winnerPoints += $scores[$i];
        }
    }
        
    $outcome = "";
    if($occurences == 1) 
                    {
                        $outcome = $players[$index]["name"] . " and " . $players[$indexTie1]["name"] . " won! The winners get: " . $winnerPoints . " points!";
                    } 
                    else if($occurences == 2) {
                        $outcome = $players[$index]["name"] . ", " . $players[$indexTie1]["name"] . ", and " . $players[$indexTie2]["name"] . " won! The winners get: " . $winnerPoints . " points!";
                    }
                    else if($occurences == 3) {
                        $outcome = $players[$index]["name"] . ", " . $players[$indexTie1]["name"] . ", " . $players[$indexTie2]["name"] . ", and " . $players[$indexTie3]["name"] . " won! The winners get: " . $winnerPoints . " points!";
                    }
                    else 
                    {
                        $outcome = $players[$index]["name"]  . " Wins " . $winnerPoints . " points!";
                    }
    
    echo $outcome;
}

function displayElapsedTime(){
    global $start;
    
    $elapsedSecs = microtime(true) - $start;
    echo "Elapsed Time: " . ($elapsedSecs * pow ( 10,3)) . " Seconds <br>"; //Gets time the page took to load.
    
    
    if ($_SESSION["timesAccessed"] == null) 
    {
    $_SESSION["timesAccessed"] ++;
    }
    else{
    $_SESSION["timesAccessed"]++; 
    }
    echo "Average Time Elapsed: " . (($elapsedSecs)/($_SESSION["timesAccessed"]) * pow(10,3))  . " Seconds <br>";
    //Takes time taken to load and divides it by the number of times the page has been accessed.
    
    echo "Total Times Played: " . $_SESSION["timesAccessed"];
    
}

?>
    

