<!DOCTYPE html>
<html>
<head>
	<title>Student Notes Sharing | Sign In</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<style type="text/css">
	.images {
        width: 100%;
        padding-bottom: 2em
	}

	.container {
	}

	.container li {
        width: 80vw;
        padding: 1em;
        line-height: 1.5;
        text-align: left;
        margin: 5em;
        /*background: #f1f1f1;*/
        /*box-shadow: 0 0 20px #00000052;*/
    }

	form {
       position: fixed;
       bottom: 0;
       max-width: 100%;
       width: 100%;
       background: transparent;
       display: flex;
       flex-direction: row;
	}

    input {
    	border: none;
    	border-bottom: none;
    }

    input[type=text] {
    	background: #444;
    	color: #fff;
    	border: none;
    	padding: 0 1em;
    }

    input[type=text]:hover {
        border-bottom: 2px solid red;
    }

	body {
		height: auto;
		background: url("images/bg2.jpg") no-repeat;
		background-size: cover;
		background-attachment: fixed
	}

	#file-input {
		/*display: none;*/
		color: #444
	}

	form label {
       color: #fff;
       background: #2196F3;
       height: 46px;
       margin-top: 29px;
       padding: 5px;
       display: none;
    }
</style>
<body>
	<form method="POST" class="data-send-section" enctype="multipart/form-data">
		<div>
			<label for="file-input">
		      <img src="images/send.svg">
	       </label>
		   <input type="file" id="file-input" name="image">
		</div>
		<input type="text" placeholder="Description" name="description">
		<input type="submit" name="submit" value="Send">
	</form>

	<?php
   if (isset($_POST['submit'])) {
   	  if (getimagesize($_FILES['image']['tmp_name'])==FALSE) {
   	  	echo "failed";
   	  } else {
   	  	$name = addslashes($_FILES['image']['tmp_name']);
   	  	$image = base64_encode(file_get_contents(addslashes($_FILES['image']['tmp_name'])));
   	  	saveImage($name, $image);
   	  }
   }

   function saveImage($description, $image) {
   	  $description = $_POST['description'];
   	  $conn = mysqli_connect('localhost', 'root', '', 'notes');
   	  $sql = "INSERT INTO data (image, description) VALUES ('$image', '$description')";
   	  $query = mysqli_query($conn, $sql);

   	  if ($query) {
   	  	  echo "Sent Successfully";
   	  	  header("Location: home.php");
   	  } else {
   	  	echo "Could not send file";
   	  }
   }
   display();

   function display() {
   	}
?>

   	<?php
   	    $conn = mysqli_connect('localhost', 'root', '', 'notes');
   	    $sql = "SELECT * FROM data";
   	    $query = mysqli_query($conn, $sql);
   	    $num = mysqli_num_rows($query);
   	    for ($key=0; $key < $num; $key++):
   	  	$result = mysqli_fetch_array($query);
   	  	$img = $result['image'];
   	?>

   	<div class="container">
   		<ul>
   	  	    <li>
   	  		    <?php echo '<img class="images" src="data:image;base64,' .$img. '">';?>
   	            <?php echo $result['description']; ?>
   	        </li>
   	    <?php endfor; ?>
   	    </ul>
   	</div>
</body>
</html>