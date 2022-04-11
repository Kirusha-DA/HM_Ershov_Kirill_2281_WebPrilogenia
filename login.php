<?php
	require_once 'header.php';
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset = "UTF-8">
		<link rel="stylesheet" href="includes/style.css">
	</head>
	<body>
		<div style="width: 400px;
			margin: 15px auto;
			padding: 20px;
			
			justify-content:space-around;
			
			background-color: #fff;
			box-shadow: 0 5px 10px #ccc;
			border-radius: 10px;">
			<form action="includes/login.inc.php" method="post" style="display: flex;
				flex-direction: column;">
			<h1>Log in</h1>
			<input type="text" name="name" placeholder="Full name">
			<input type="password" name="pwd" placeholder="Password">
			<button type="submit" name="submit">Log in</button>
		</div>
	</form>
	</body>

<?php
	require_once 'footer.php';
?>