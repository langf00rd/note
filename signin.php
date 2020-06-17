<!DOCTYPE html>
<html>
<head>
	<title>Student Notes Sharing | Sign In</title>
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
	<h2 class="title"> Sign In </h2>
	<form action="signin.php" method="POST">
		<input type="text" name="user_name" placeholder="User name">
		<br>
		<br>
	    <input type="password" name="user_password" maxlength="10" minlength="10" required placeholder="Password">
		<br>
		<br>
		<input type="submit" name="signin" value="Sign In">
		<br>
		<br>
		<div>
			<a href="index.php">Create new account</a>
		</div>
	</form>

	<?php
	    include_once "includes/dbconn.php";
	    if (isset($_POST['signin'])) {

	        $name = $_POST['user_name'];
	        $password = $_POST['user_password'];

	        $select = "SELECT * FROM users where user_name = '$name' AND user_password = '$password'";
	        $query = mysqli_query($conn, $select);
	        $check_user = mysqli_num_rows($query);

	        if ($check_user == 1) {
	        	header("Location: home.php?signin=success");
	        }else {
	            $msg = "Username or password might be incorrect";
	            echo '<br><p class="err_msg">' .$msg. '</p>';
	        }
	    }
	?>
</body>
</html>