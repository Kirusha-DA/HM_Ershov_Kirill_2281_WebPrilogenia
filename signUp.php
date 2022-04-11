<?php
	require_once 'header.php';
?>

<section>
	<form action="includes/signUp.inc.php"
	method="post"
	style="display: flex;
			flex-direction: column;">
		
		<div name="error" id="error">
			<?php
				if (isset($_GET['error'])){
					if ($_GET['error'] === 'emptyfield'){
						echo '<span style="color: red">Please fill all fields
						</span>';
					}
					else if ($_GET['error'] === 'notMail'){
						echo '<span style="color: red">Not real format of email
						</span>';
					}
					else if ($_GET['error'] === 'wrongpwd'){
						echo '<span style="color: red">Passwords do not match 
						</span>';
					}
					if ($_GET['error'] === 'emailexists'){
						echo '<span style="color: red">Email already exists
						</span>';
					}
				}
			?>
		</div>
		<div style="width: 400px;
			margin: 15px auto;
			padding: 20px;
			
			justify-content:space-around;
			
			background-color: #fff;
			box-shadow: 0 5px 10px #ccc;
			border-radius: 10px;">
			<h1>Sign up</h1>
			<input type="text" name="name" placeholder="Full name">
			<input type="text" name="email" placeholder="Email">
			<input type="password" name="pwd" placeholder="Password">
			<input type="password" name="pwd_repeat" placeholder="Repeat password">
			<button type="submit" name="submit">Sing up</button>
		</div>
	</form>
</section>

<?php
	require_once 'footer.php';
?>