<!DOCTYPE html>
<html>
<head>
	<title>Student Notes Sharing | Sign Up</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<style type="text/css">
	.err_msg {
        color: #fff;
        padding: .7em;
        background: #ff3324;
        font-size: 13px;
	}
</style>
<body>
	<h2 class="title"> Sign Up </h2>
	<form action="index.php" method="POST">
		<input type="text" name="user_name" placeholder="User name">
		<br>
		<br>
		<input type="email" name="user_email" placeholder="E-mail">
		<br>
		<br>
	    <input type="password" name="user_password" maxlength="10" minlength="10" required placeholder="Password">
		<br>
		<br>
		<input type="submit" name="signup" value="Sign In">
		<br>
		<br>
		<div>
			<a href="signin.php">Already have an account ?</a>
		</div>
	</form>

	<?php
	    include_once "includes/dbconn.php";

	    if (isset($_POST['signup'])) {

	        $name = $_POST['user_name'];
	        $email = $_POST['user_email'];
	        $password = $_POST['user_password'];

	        $select = "SELECT * FROM users where user_name = '$name' AND user_email = '$email' AND user_password = '$password'";
	        $query = mysqli_query($conn, $select);
	        $check_user = mysqli_num_rows($query);

	        if ($check_user == 1) {
	        	$err_msg = "Account already exists";
	        	echo '<p class="err_msg">' .$err_msg. '</p>';
	        }else {
	        	$insert = "INSERT INTO users (user_name, user_email, user_password) VALUES ('$name', '$email', '$password')";
	        	mysqli_query($conn, $insert);

	        	header("Location: signin.php?signin=success");
	        }
	    }
	?>
</body>
</html>