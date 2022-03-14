<?php 
require 'server.php';

    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == 1){
        header('location: homepage.php', true);
    }

    if (isset($_POST['login'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $errors = [];
    
        empty($email) ? array_push($errors, "Field Email is required") : '';
        empty($password) ? array_push($errors, "Field Password is required") : '';
    
        if (count($errors) == 0) {
            $password = md5($password);
    
            $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
            $results = mysqli_query($conn, $query);
            if (mysqli_num_rows($results) == 1) {
                $_SESSION['email'] = $email;
                $_SESSION['loggedin']  = 1;
                header('location: homepage.php');
            } else {
                array_push($errors, "Wrong username/password combination");
            }
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login - Registration</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Login</h2>
  </div>
	 
  <form method="post" action="login.php">
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  	<p>
  		Not yet a member? <a href="register.php">Sign up</a>
  	</p>
  </form>
</body>
</html>