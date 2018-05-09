<!DOCTYPE html>
<html>
    <head>
        <title> Admin Login </title>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style>
            #loginForm{
                color:green;
            }
            #body{
                background-color:silver;
            }
            
            
        </style>
    </head>
    <body id="body">
        <div class="w3-container w3-black">
        <h1><font color="green">NTE's Pocket Protector - Admin Login</font> </h1>
        </div>
        <form id ="loginForm"method="POST" action="loginProcess.php" class="col-md-4 col-md-offset-4">
            <br>
            Username: <input type="text" name="username"/> <br><br>
            Password: <input type="password" name="password"/> <br><br>
            
            <input class="btn btn-success"type="submit" name="submitForm" value="Login!" />
            
        </form>

    </body>
</html>