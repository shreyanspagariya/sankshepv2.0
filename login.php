<html>
<head>
	<link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
	<div class="container">
		<br><br>
		<center>
			<h1><b>Welcome to ML@Kgp!</b></h1>
			<h5>Search for Video Lectures and Topic-Wise Clips on Machine Learning.</h5><br>
			<br><br>
		</center>
			<div class="row">
				<div class = "col-md-6">
				<center><h2>Login</h2></center><br>
				<form action="backend/login-backend.php" method="POST">
				  <div class="form-group">
				    <input type="email" class="form-control" name="login_email" aria-describedby="emailHelp" placeholder="Email">
				  </div>
				  <div class="form-group">
				    <input type="password" class="form-control" name="login_pass" placeholder="Password">
				  </div>
				  <center><button type="submit" class="btn btn-primary">Login</button></center>
				</form>
				</div>
				<div class = "col-md-6">
				<center><h2>Signup</h2></center><br>
				<form action="backend/signup-backend.php" method="POST">
				  <div class="form-group">
				    <input class="form-control" name="signup_name" aria-describedby="emailHelp" placeholder="Name">
				  </div>
				  <div class="form-group">
				    <input type="email" class="form-control" name="signup_email" aria-describedby="emailHelp" placeholder="Email">
				    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
				  </div>
				  <div class="form-group">
				    <input class="form-control" name="signup_roll" aria-describedby="emailHelp" placeholder="Roll Number">
				  </div>
				  <div class="form-group">
				    <input type="password" class="form-control" name="signup_pass" placeholder="Password">
				  </div>
				  <center><button type="submit" class="btn btn-primary">Signup</button></center>
				</form>
				</div>
			</div>
	</div>
</body>