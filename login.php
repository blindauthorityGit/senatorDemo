<?php
// Sicherheit -----------------------------------------------------------------
session_name("NFC");
session_start();
// session_gc();(PHP 7 >= 7.1.0)
session_destroy();
// ----------------------------------------------------------------------------
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">  
        <!-- <meta name="description" content=""> -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="css/main.css">
		<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,700,900|PT+Sans&display=swap" rel="stylesheet">


        <!-- JavaScript -->
        <script src="js/login.min.js"></script>
		
        <title>Login</title>
        
    </head>
    <body class="login_body" style="font-family: 'PT Sans">
        <form id="loginForm" class="signupform" method="POST"></form>
        <div class="wrapper">
        	<div class="signupbox">
        		<form class="signupform">
				<div class="imgwrapper">	
				<img src="./img/logo.png" alt="XCC Logo"></div>
        			<h1 class="signupfor" style="margin-top: 50px;">Login</h1>
        			<div class="signupsection">
	        			<label for="">Username</label>
						<input form="loginForm" type="text" class="username" name="username">
					</div>
					<div class="signupsection">
	        			<label for="">Password</label>
						<input form="loginForm" type="password" class="password" name="password">
					</div>
						<div class="signupsection">
                        <input class="login_input" form="loginForm" type="submit" name="submit" value="Login" id="submit">
                        
					</div>

					<div class="alert">
						<p id="errorlogin">Login Daten sind inkorrekt</p>
					</div>
        		</form>
                
               

        	</div>

			

        </div>


        
        
    </body>
</html>

