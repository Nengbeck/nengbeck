<?php

  $backgroundImage = "img/sea.jpg";
    
  if (isset($_GET['keyword'])) { 
      include 'api/pixabayAPI.php';
      $keyword = $_GET['keyword'];
      echo "<h3>You searched for " . $_GET['keyword'] . "</h3>";
      $imageURLs = getImageURLs($_GET['keyword']);
      $backgroundImage = $imageURLs[array_rand($imageURLs)];
  }  
?>


<!DOCTYPE html>
<html>
    <head>
        <title> Lab 4: Pixabay Carousel </title>
        <meta charset= "utf-8">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="systelsheet">
        
        <style>
            @import url("https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css");
            @import url("css/styles.css");
            body 
            {
                    background-image: url(<?=$backgroundImage?>);
            }
            #carouselExampleControls
            {
             width: 500px;
             margin: 0 auto;
            }
        </style>
    </head>
    <body>
        <br>
        <?php
        $i = rand(0,25);
        
            if(!isset($imageURLs)){
                echo "<h2>Type a keyword to display a slideshow with random images from Pixabay.</h2>";
            } else {
        ?>
        
        <?php
        if(isset($_GET['keyword'])) {
        ?>
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="6"></li>
              </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img class="d-block w-100" src="<?=$imageURLs[0+$i]?>" alt="First slide">
            </div>
            
            <div class="carousel-item">
              <img class="d-block w-100" src="<?=$imageURLs[1+$i]?>" alt="Second slide">
            </div>
            
            <div class="carousel-item">
              <img class="d-block w-100" src="<?=$imageURLs[2+$i]?>" alt="Third slide">
            </div>
            
             <div class="carousel-item">
              <img class="d-block w-100" src="<?=$imageURLs[3+$i]?>" alt="fourth slide">
            </div>
            
             <div class="carousel-item">
              <img class="d-block w-100" src="<?=$imageURLs[4+$i]?>" alt="fifth slide">
            </div>
            
             <div class="carousel-item">
              <img class="d-block w-100" src="<?=$imageURLs[5+$i]?>" alt="sixth slide">
            </div>
            
            <div class="carousel-item">
              <img class="d-block w-100" src="<?=$imageURLs[6+$i]?>" alt="seventh slide">
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
        
        <?php
           }
        ?>
        <br>
        <!-- //////////////////////////////// -->
        
        <form method="GET">
            <input type="text" name="keyword" placeholder="keyword" value="<?=$_GET['keyword']?>"/>
            <input type="radio" id="lhorizontal" name="layout" value="horizontal"/>
            <label for="Horizontal"></label><label for="lhorizontal"> Horizontal </label>
            <input type="radio" id="lvertical" name="layout" value="vertical">
            <label for="Vertical"></label><label for="lvertical"> Vertical </label>
            
            <select name="category">
                <option value ="">Select One</option>
                <option value="sea" name="keyword">Sea</option>
                <option value="forest">Forest</option>
                <option value="mountain">Mountain</option>
                <option value="snow">Snow</option>
            </select>
            <input type="submit" value="Search"/>
        </form>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384"></script>
         <footer>
            <figure id="buddyID">
                <img src="img/buddy_verified.png" alt="CSUMB_logo"/>
            </figure>
            
        </footer>
    </body>
</html>