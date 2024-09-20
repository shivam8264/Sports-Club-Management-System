<?php

session_start();
if(isset($_SESSION["user_data"]))
{
	header("location:./dashboard/admin/");
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Sports Club | Login</title>
	<link rel="stylesheet" href="./css/style.css"/>
	<link rel="stylesheet" type="text/css" href="./css/entypo.css">
</head>
<style>
h2 {
  color: #FFD700; /* Gold color */
  background-image: url("blaze_back_new.png");
  width: 100%; /* Full width */
  text-align: center; /* Center align text */
  font-size: 50px; /* Increased font size */
  margin: 0; /* Remove default margin */
  padding: 40px 0; /* Padding for spacing */
}
body {
  background-color: #1E1E1E; /* Dark background for better contrast */
}
.input-group {
  margin-left: 20px; /* Add margin to the left of the input group */
}
</style>
<body>
    <h2>WELCOME TO <br>SPORTS CLUB</h2>
<body class="page-body login-page login-form-fall">
    
    	<div id="container">
			<div class="login-container">
	
	<div class="login-header login-caret">
		
		<div class="login-content">
			
			<a href="#" class="logo">
				<img src="logo.png" alt="" />
			</a>
			
			<p class="description" style="color: #FFFFFF; font-size: 18px;">Dear user, log in to access the admin area!</p>
			
			<!-- progress bar indicator -->
			<div class="login-progressbar-indicator">
				<h3 style="color: #FFD700;">43%</h3>
				<span style="color: #FFFFFF;">logging in...</span>
			</div>
		</div>
		
	</div>
	
	<div class="login-progressbar">
		<div></div>
	</div>
	
	<div class="login-form">
		
		<div class="login-content">
			
			<form action="secure_login.php" method='post' id="bb">				
				<div class="form-group">					
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-user"></i>
						</div>
							<input type="text" placeholder="User ID" class="form-control" name="user_id_auth" id="textfield" data-rule-minlength="6" data-rule-required="true">
					</div>
				</div>				
								

				<div class="form-group">					
					<div class="input-group">
						<div class="input-group-addon">
							<i class="entypo-key"></i>
						</div>
						<input type="password" name="pass_key" id="pwfield" class="form-control" data-rule-required="true" data-rule-minlength="6" placeholder="Password">
					</div>				
				</div>
				
				<div class="form-group">
					<button type="submit" name="btnLogin" class="btn btn-primary" style="font-size: 18px;">
						Login In
						<i class="entypo-login"></i>
					</button>
				</div>
			</form>
		
				<div class="login-bottom-links">
					<a href="forgot_password.php" class="link" style="color: #FFD700;">Forgot your password?</a>
				</div>			
		</div>
		
	</div>
	
</div>

		</div>

</body>
</html>
