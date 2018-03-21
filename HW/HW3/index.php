
<?php
// define variables and set to empty values
$name = $superPower = $gender = $motto = $origin = $goodOrEvil = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = test_input($_POST["name"]);
  $superPower = test_input($_POST["superPower"]);
  $origin = test_input($_POST["origin"]);
  $motto = test_input($_POST["motto"]);
  $gender = test_input($_POST["gender"]);
  $goodOrEvil = test_input($_POST["goodOrEvil"]);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<html>
    
     <head>
        <meta charset = "utf-8" />
        <title> Homework#3 </title>
        <link href="css/styles.css" rel="stylesheet" type="text/css" />
    </head>

<h2>The Legend of CSUMB's Powerful Wizard</h2>
<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
      Gender:
      <input type="radio" name="gender" <?php if (isset($_POST['gender']) && $_POST['gender']=="womanly") echo "checked = checked";?>value="womanly">Womanly
      <input type="radio" name="gender" <?php if (isset($_POST['gender']) && $_POST['gender']=="manly") echo "checked = checked";?>value="manly">Manly
      <br><br>
      
      Name: <input type="text" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>">
      <br><br>
      
      Super Power: <input type="text" name="superPower" value="<?php echo isset($_POST['superPower']) ? $_POST['superPower'] : '' ?>">
      <br><br>
      
      Land of Origin: <input type="text" name="origin" value="<?php echo isset($_POST['origin']) ? $_POST['origin'] : '' ?>">
      <br><br>
      
      Good or Evil:
      <input type="radio" name="goodOrEvil" <?php if (isset($_POST['goodOrEvil']) && $_POST['goodOrEvil']=="Evil") echo "checked = checked";?>value="Evil">Evil
      <input type="radio" name="goodOrEvil" <?php if (isset($_POST['goodOrEvil']) && $_POST['goodOrEvil']=="Good") echo "checked = checked";?>value="Good">Good
      <br><br>
      
      motto: <textarea name="motto" rows="5" cols="40"> <?php if(isset($_POST['motto'])) { 
             echo htmlentities ($_POST['motto']); }?></textarea>
      <br><br>
      
      <input type="submit" name="submit" value="Submit">  
    </form>

<div>
    <?php
    echo "<h2>The Legend...</h2>";
    echo "There was once a ";
    echo $gender;
    echo " wizard <br>";
    echo "Who was ";
    echo $goodOrEvil;
    echo "<br>";
    echo "Named ";
    echo $name;
    echo "<br>";
    echo "Who was capable of ";
    echo $superPower;
    echo "<br>";
    echo "No one knows for sure, but it is agreed that ";
    echo $origin;
    echo " was the origin of this power...";
    echo "<br>";
    echo $name;
    echo " always swore ";
    echo $motto;
    echo "<br>";
    echo "No one knows what finally became of this wizard... It is a mystery as mysterious as the Wizard's powers"
    ?>
    </div>

    <footer id="foot">
        <hr>
        CST336 Internet Programming. 2018&copy; Engbeck <br />
        <br />
        <br />
        <img src="img/csumb_logo.1.jpg" alt="CSUMB Logo" height = 125, width = 200/>
    </footer>

    </body>
</html>

