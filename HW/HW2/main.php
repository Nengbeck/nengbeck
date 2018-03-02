<?php

 //print_r($_GET); //displaying all content submitted in the form using the GET method

  $backgroundImage = "img/sea.jpg";
    
  if (isset($_GET['keyword'])) { //if form was submitted
      
      include 'api/pixabayAPI.php';
      
      echo "<h3>You searched for " . $_GET['keyword'] . "</h3>";
      
      $orientation = "horizontal";
      $keyword = $_GET['keyword'];
      
      if (isset($_GET['layout'])) {  //user checked a layout
        
        $orientation = $_GET['layout'];
        
      }
      
      if (!empty($_GET['category'])) { //user selected a category
        $keyword = $_GET['category'];
      }
      
      $imageURLs = getImageURLs($keyword, $orientation);
      
      //$backgroundImage = $imageURLs[rand(0, count($imageURLs)-1];
      $backgroundImage = $imageURLs[array_rand($imageURLs)];
      
      //print_r($imageURLs);
      
      
  }      
 
 function checkCategory($category){
   
    if ($category == $_GET['category']) {
       echo " selected";
    }
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
        
        #carouselExampleIndicators {
            width: 500px;
            margin: 0 auto; /*centers a div container*/
        }
         
    </style>
    <body>

        <?php
        
            if (!isset($_GET['keyword'])) {
        
              echo "<h2> You must type a keyword or select a category </h2>";
            
            }  
        ?>

        

        <form method="GET">
            
            <input type="text" size="20" name="keyword" placeholder="Keyword to search for" value="<?=$_GET['keyword']?>"/>
            
            <input type="radio" name="layout" value="horizontal" id="hlayout" 
            
            <?php
               if ($_GET['layout'] == "horizontal") {
                 echo "checked";
               }
            ?>
            
            >
            <label for="hlayout"> Horizontal </label>
            
            <input type="radio" name="layout" value="vertical" id="vlayout" <?= ($_GET['layout']=="vertical")?"checked":"" ?>>
            <label for="vlayout"> Vertical </label>
            
            <select name="category">
              <option value="" >  Select One </option> 
              <option value="sea" <?=checkCategory('sea')?>>  Ocean </option>
              <option <?=checkCategory('Forest')?>>  Forest </option>
              <option <?=checkCategory('Sky')?>>  Sky </option>
            </select>
            
            
            <input type="submit" value="Submit!"/>
                    
        </form>
        
        <?php
          
           if (isset($_GET['keyword'])) {
        ?>
        
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
              </ol>
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
              </div>
              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
        </div>
        
        <?php
            }//endIf
        ?>
        
        

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    </body>
</html>