<?php
session_start();

if(!isset($_SESSION['zipcode'])) {
        
        $_SESSION['zipcode'] = $_POST['zipcode'];
    }
    
    
//$_SESSION[''];



?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>AJAX: Sign Up Page</title>
        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
        
        
        <script>
            
             var errorCount = 0;
            $(document).ready( function(){
                
                //EVENTS
                
                $("#username").change( function(){ 
                    //alert( $("#username").val() )
                    
                    $.ajax({

                        type: "GET",
                        url: "checkUsernameAPI.php",
                        dataType: "json",
                        data: { "username": $("#username").val() },
                        success: function(data,status) {
                             //alert(data);
                             
                             if (!data) {  //data == false
                             
                                //alert("Username is Available");
                                document.getElementById("usernameP").innerHTML = "<span style='color: green'><b>Username is available!</b></span>";
                                errorCount = 0;
                             } else {
                                 
                                //alert("Username is ALREADY TAKEN");
                                document.getElementById("usernameP").innerHTML = "<span style='color: red'><b>Username is already Taken!</b></span>";
                                errorCount = 1; 
                             }
                             
                        
                        },
                        complete: function(data,status) { //optional, used for debugging purposes
                        //alert(status);
                    }

});//ajax
                    
                });
                
                
                $("#state").change( function () {
                    //alert("hi")
                    //alert( $("#state").val());
                    
                    $.ajax({

                        type: "GET",
                        url: "http://itcdland.csumb.edu/~milara/ajax/countyList.php",
                        dataType: "json",
                        data: { "state": $("#state").val()},
                        success: function(data,status) {
                        //alert(data[0]['county']);
                        //alert(data[0].county);
                        $("#county").html("<option>Select One</option>");
                        for(var i=0; i<data.length; i++)
                        {
                           $("#county").append("<option>" + data[i].county + "</option>"); 
                        }
                        
                        },
                        complete: function(data,status) { //optional, used for debugging purposes
                        //alert(status);
                        }
                        
                    });//ajax
                    
                    
                });
                
                
                $("#zipCode").change( function(){  
                    alert( $("#zipCode").val() );
                    
                    $.ajax({
                        type: "GET",
                        url: "http://itcdland.csumb.edu/~milara/ajax/cityInfoByZip.php",
                        dataType: "json",
                        data: { "zip": $("#zipCode").val() },
                        success: function(data,status) {
                        
                           $("#city").html(data.city);
                           $("#lat").html(data.latitude);
                           $("#long").html(data.longitude);
                        
                        },
                        complete: function(data,status) { //optional, used for debugging purposes
                        
                        
                        //if(typeof data.zipcode == 'undefined')
                        //if($("#long").html(data.longitude) == 'undefined')
                        if($("#zipCode").val()== "")
                        {
                            $("#zip").html("No zipcode found...");
                            $("#zip").html("<span style='color: red'><b>No matches found for that Zipcode</b></span>");
                        }
                        
                          
                            
                        }
                        
                    });//ajax
                    
                    
                } ); //#zipCode Event 
                

            $("#password2").change (function ()
            {
                //alert($("#password2").val());
                if ($("#password2").val() != $("#password").val() && $("#password2").val() != "" && $("#password").val() != "")
                {
                    $("#passwordP").html("<span style='color: red'><b>Passwords don't match!</b></span>");
                    errorCount = 1;;
                }
                else 
                {
                    $("#passwordP").html("<span style='color: green'><b>Passwords match!</b></span>");
                    errorCount=0;
                }
            })
                
            } ); //documentReady
            

        </script>

    </head>

    <body>
    
       <h1> Sign Up Form </h1>
    
        <form onsubmit="return validateForm()" method="POST">
            <fieldset>
               <legend>Sign Up</legend>
                First Name:  <input type="text" id="fName"><br> 
                Last Name:   <input type="text" id="lName"><br> 
                Email:       <input type="text"><br> 
                Phone Number:<input type="text"><br><br>
                Zip Code:    <input name="zipcodeForm"type="text" id="zipCode"><span id="zip"></span><br>
                City:        <span id="city" value=""></span>
                <br>
                Latitude:    <span id="lat"></span>
                <br>
                Longitude:   <span id="long"></span>
                <br><br>
                State:     
                <select id="state">
                    <option value="">Select One</option>
                    <option value="ca"> California</option>
                    <option value="ny"> New York</option>
                    <option value="tx"> Texas</option>
                    <option value="va"> Virginia</option>
                </select><br />
                
                Select a County: <select id="county"></select><br>
                
                Desired Username: <input id="username" type="text"><br>
                <p id="usernameP"></p>
                
                Password: <input id="password" type="password"><br>
                
                Type Password Again: <input id="password2" type="password"><br>
                <p id="passwordP"></p>
                
                <input type="submit" value="Sign up!">
                <p id="addedUser"></p> 
            </fieldset>
        </form>
        <script>
        
       /////////////////////////////////////////////////////////////////////////
       /////////////////////////////////////////////////////////////////////////
        
            function validateForm() 
            {
                //alert();
                if(errorCount == 0)
                {
                    alert(data);
                     $.ajax({

                        type: "GET",
                        url: "addUserAPI.php",
                        dataType: "json",
                        data: { 
                                "username": $("#username").val(), 
                                "password": $("#password").val(),
                                "fName": $("#fName").val(),
                                "lName": $("#lName").val(),
                                "zipCode": $("#zipCode").val()
                        },
                        success: function(data,status) {
                        
                        alert(data);
                        document.getElementById("#addedUser").innerHTML = "<span style='color: green'><b>User has been added</b></span>";
                               
                            
                             
                             
                        },
                        complete: function(data,status) { //optional, used for debugging purposes
                        //alert(status);
                        //alert(data);
                    }

            });//ajax
                }
                return false;
           
            }
            
        </script>
    
    </body>
</html>