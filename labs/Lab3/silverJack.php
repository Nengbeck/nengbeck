<!DOCTYPE html>


 <?php 
 include('functions.php');
 ?>

<html>
    
<!-- All styles and javascript go inside the head -->
    <head>
        <title>Lab 3</title>
        <meta charset="utf-8" />
        <style>
            @import url("css/styles.css");
            
        </style>
        <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
      
    </head>

<!-- This is the body -->
<body>
    <header>
        <h1>Silver Jack</h1>
    </header>
    
    <!-- Created a <div> to add the images to -->
    <div class="winner">
        <h1 style="color:red;float:center;"><?php  displayWinner($hands,$players); ?> </h1>
    </div>
    <div class="box">
        
        <!-- The images used -->
         
        <div class="card">
        <h3> <?php echo $players[0]["name"]; ?> </h3>
           
        <img src=<?php echo $players[0]['linkToImage']; ?> alt="Picture of  wonder woman" border="5px" >
          <?php displayHand($hands[0],$suits[0]); ?>
          
         </div>
  
          
     
        <div class="card">
        <h3><?php echo $players[1]["name"]; ?></h3>
        <img src=<?php echo $players[1]['linkToImage']; ?> alt="Picture of the flash" border="5px" />
            <?php displayHand($hands[1],$suits[1]); ?>
        </div>
      

    
        
        <div class="card" >
        <h3><?php echo $players[2]["name"]; ?></h3>
        <img src=<?php echo $players[2]['linkToImage']; ?> alt="Picture of superman" border="5px"/>
            <?php displayHand($hands[2],$suits[2]); ?>
        </div>
        
        
      
      
        
        <div class="card" >
        <h3><?php echo $players[3]["name"]; ?></h3>
        <img  src=<?php echo $players[3]['linkToImage']; ?> alt="Picture of Batman" border="5px" />
            <?php 
            displayHand($hands[3],$suits[3]); 
            ?>
        <div id = "elapsedTime">    
            <?php 
            displayElapsedTime();
            ?>
        </div>
        </div>
     
        <br>
       
        <form>
            <input type="submit" value="Play"/>
        </form>
    
    </div> 
    
    
</body>
</html>
