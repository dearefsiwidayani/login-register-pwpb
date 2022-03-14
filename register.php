<?php 
    require 'server.php';

    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == 1){
        header('location: hompage.php', true);
    }

    if (isset($_POST['register'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];

        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        $errors = [];

        empty($name) ? array_push($errors, "Fieluiredd Name is req") : '';
        empty($email) ? array_push($errors, "Field Email is required") : '';
        empty($password) ? array_push($errors, "Field Password is required") : '';
        empty($confirm_password) ? array_push($errors, "Field Confirm Password is required") : '';

        $password != $confirm_password ? array_push ($errors, "Password you typed doesn't match") : '';

        if (count($errors) == 0) {
            $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
            $result = mysqli_query($conn, $user_check_query);
            $user = mysqli_fetch_assoc($result);

            // Checking user in database
            if ($user) {
                if ($user['email'] === $email) {
                    array_push($errors, "Email already exists");
                }
            }

            $password = md5($password);
            $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
            mysqli_query($conn, $query);
            $_SESSION['email'] = $email;
            $_SESSION['loggedin']  = 1;
            header('location: homepage.php');
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Register</h2>
  </div>
	
  <form method="post" action="register.php">
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="login.php">Sign in</a>
  	</p>
  </form>
</body>
</html>