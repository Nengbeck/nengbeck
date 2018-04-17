<?php 

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset = "utf-8" />
        <title>Java Script Practice </title>
        <script type="text/javascript" src = "javaSCriptPractice.js"></script>
        <script language="javascript">
            
        function printStuff()
        {
            document.write("Yo Yo I'm a function")
        }
        
            var answer = prompt("What is 2 + 2?");
            
            if (answer == 4)
            {
                document.write("<h1>You are Correct!</h1>")
            }
            else if (answer == 5)
            {
                document.write("<h1>WHAT?!?!?</h1>")
            }
            else
            {
                document.write("<h1>Wrong</h1>")
            }
            
        printStuff();    
        </script>
         
    </head>
    
    
    <body onload="printStuff()">

    </body>
</html>