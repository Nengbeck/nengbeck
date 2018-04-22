    ////////////////////////////////////////////////////////////////////////////
    //////////////////////////////// Variables /////////////////////////////////
    var selectedWord = "";
    var selectedHint = "";
    var board = [];  //array
    var guesses = [];
    var remainingGuesses = 6;
    var words = [{ word: "snake", hint: "It's a reptile"},
            { word: "monkey", hint: "It's a mammal"},
            { word: "beetle", hint: "It's an insect"},
            { word: "dog", hint: "It's a common pet"},
            { word: "turtle", hint: "It has a hard shell"}];
             
    var alphabet = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 
                'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 
                'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];

    ///////////////////////////////// Listeners ////////////////////////////////
    window.onload = startGame();
  

    
    $(".letter").click( function() 
    {
    checkLetter($(this).attr("id"));
    disableButton($(this));
    });

    $("#hint").click( function() 
    {
    displayHint();
    });

    $(".replayBtn").on("click", function() 
    {
    location.reload();
    });

    ////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////
    //////////////////////////////// Functions /////////////////////////////////
     
    function startGame() 
    {
    pickWord();
    initBoard();
    updateBoard();
    createLetters();
    $('#lost').hide();
    $('#won').hide();
    displayHistory();
    }
            
    function initBoard() 
    {
                
    for(var letter in selectedWord) 
    {
        board.push("_");
    }
    
    updateWords();
    }
  
    function pickWord() 
    {
        var randomInt = Math.floor(Math.random() * words.length);
        selectedWord = words[randomInt].word.toUpperCase();
        selectedHint = words[randomInt].hint;
    }
            

    function createLetters() 
    {
        for(var letter of alphabet) 
        {
            $("#letters").append("<button class='letter' id='" + letter + "'>" + letter +"</button>");
        }
    }

    function checkLetter(letter) 
    {
        var positions = new Array();
                    
        for(var i = 0; i < selectedWord.length; i++) 
        {
            if(letter == selectedWord[i]) 
            {
                positions.push(i);
            }
        }
                    
        if(positions.length > 0) 
        {
            updateWord(positions, letter);
            
            if(!board.includes('_')) 
            {
                endGame(true);
            }
        }
                    
        else 
        {
            remainingGuesses -= 1;
            updateMan();
        }
        
        if(remainingGuesses <= 0) 
        {
            endGame(false);
        }
    }
            
    function updateWord(positions, letter) 
    {
        for(var pos of positions) 
        {
        board[pos] = letter;
        }
                
        updateBoard();
    }

    function updateMan() 
    {
        $("#hangImg").attr("src", "img/stick_" + (6 - remainingGuesses) + ".png");
    }

    function updateBoard() 
    {
        $("#word").empty();
      
        for(var i = 0; i < board.length; i++) 
        {
            $("#word").append(board[i] + " ");
        }
    }

    function updateWords() 
    {
    
        for(var i = 0; i < guesses.length; i++) 
        {
            if(guesses.length == 1) 
            {
                $("#history").append(guesses[i]);
                displayHistory();
            }
        
            else 
            {
                $("#history").append(guesses[i] + ", ");
                displayHistory();
            }
       
        }
    }
    function displayHistory()
    {
        for( var i = 0; i < guesses.length;i++)
        {
            document.write($('#history').guesses[i]);
        }
    }
    
    function endGame(win) 
    {
        $("#letters").hide();
    
        if(win) 
        {
            $('#lost').hide();
            $('#won').show();
            guesses.push(selectedWord);
            updateWords();
        }
    
        else 
        {
            $('#won').hide();
            $('#lost').show();
        }
    }

    function displayHint() 
    {
        $("#word").append("<br />");
        $("#word").append("<span class='hint'>Hint: " + selectedHint + "</span>");
        remainingGuesses--;
        updateMan();
    }

    function disableButton(btn) 
    {
        btn.prop("disabled", true);
        btn.attr("class", "btn btn-danger")
    }