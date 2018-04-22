
<!DOCTYPE html>
<html>
    <head>
        <title> JavaScript Quiz </title>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    
       <script>
            
            $(document).ready( function(){
                
                
                  $("#submitBtn").click( function(){ 
                      //alert(  $("#q1").val()  );
                      
                      if (  $("#q1").val() == "Sacramento"  ) {
                          
                         // alert("Correct!");
                         
                         $("#feedback1").html(" Correct! The capital is Sacramento!");
                         
                          
                      } 
                      else 
                      {
                          
                         // alert("Incorrect!");
                         
                            $("#feedback1").html(" Incorrect! The capital is Sacramento!");
                         
                      }
                      
                      if(  $("#q2").val() == "intel"  ) {
                          
                         // alert("Correct!");
                         
                         $("#feedback2").html(" Correct! Intel does make better processors ");
                         
                          
                      } else {
                          
                         // alert("Incorrect!");
                         
                            $("#feedback2").html("Incorrect! Intel makes better processors");
                         
                      }
                      
                      
                      
                  } );
                
                
                
            });
            
            
            
        </script>        
    
    </head>
    <body>


        1. What is the capital of California?
        
        <input id="q1" type="text">
        
        <div id="feedback1"></div>
        
        
        

        2. Who makes the best computer processor?
        
        
        <select id="q2">
          <option value="intel">intel</option>
          <option value="amd">AMD</option>
        </select>
        

        <div id="feedback2"></div>
        
        
        <button id="submitBtn"> Submit Quiz </button>
        

    </body>
    
  
</html>