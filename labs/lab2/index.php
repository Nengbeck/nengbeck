<!DOCTYPE html>
<html>
    <head>
        <title> 777 Slot Machine </title>
        <meta charset="utf-8" />
    </head>
    <body>

    <?php
    for($i=1;$i<4;$i++)
    {
        ${"randomValue" . $i } = rand(0,2);
        displaySymbol(${"randomValue" . $i} );
    }
    
    function displaySymbol($randomValue)
    {
    switch($randomValue)
    {
        case 0: $symbol = "seven";
                break;
        case 1: $symbol = "cherry";
                break;
        case 2: $symbol = "lemon";
                break;
    }
    echo "<img src='img/$symbol.png' alt='$symbol' title='symbol' width='70' >";
    
    }
    ?>
      

    </body>
</html>