<?php

 //print_r($_GET); //displaying all content submitted in the form using the GET method

  $backgroundImage = "img/sea.jpg";
    
  if (isset($_GET['keyword'])) { //if form was submitted
      
      include 'api/pixabayAPI.php';
      
      echo "<h3>You searched for " . $_GET['keyword'] . "</h3>";
      
      $imageURLs = getImageURLs($_GET['keyword']);
      
      //print_r($imageURLs);
      
      //$backgroundImage = $imageURLs[rand(0, count($imageURLs) - 1)];
      $backgroundImage = $imageURLs[array_rand($imageURLs)];
  }  
        
 

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Lab 4: Pixabay Carousel </title>
    </head>
    <style>
        @import url("https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css");
        @import url("css/styles.css");
        body {
            background-image: url(<?=$backgroundImage?>);
        }
        #carouselExampleControls{
         width: 500px;
         margin: 0 auto;
        }
         
    </style>
    <body>

        <?php
        
            if (!isset($_GET['keyword'])) {
        
              echo "<h2> You must type a keyword or select a category </h2>";
            
            }  
        ?>
        
        <form method="GET">
            
            <input type="text" size="20" name="keyword" placeholder="Keyword to search for"/>
            
            <input type="submit" value="Submit!"/>
                    
        </form>
        
        <?php
        if(isset($_GET['keyword'])) {
        ?>
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img class="d-block w-100" src="<?=$imageURLs[0]?>" alt="First slide">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?=$imageURLs[1]?>" alt="Second slide">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="<?=$imageURLs[2]?>" alt="Third slide">
            </div>
             <div class="carousel-item">
              <img class="d-block w-100" src="<?=$imageURLs[3]?>" alt="Third slide">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
        <?php
        }
        ?>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    </body>
</html>