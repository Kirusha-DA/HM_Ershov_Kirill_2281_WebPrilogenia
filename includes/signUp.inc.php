<?php
	if (isset($_POST['submit'])) {
		$name=$_POST['name'];
		$email=$_POST['email'];
		$pwd=$_POST['pwd'];
		$pwd_repeat=$_POST['pwd_repeat'];
		
		require_once 'dbpdoconnection.inc.php';
		require_once 'function.inc.php';
		
		if (emptyField([$name, $email, $pwd, $pwd_repeat]) ){
			header('location: ../signUp.php?error=emptyfield');
			exit();
		}
		
		if (existUser($pdo, $email)) {
			header('location: ../signUp.php?error=emailexists');
			exit();
		}

		if (isMail($email)) {
			header('location: ../signUp.php?error=notMail');
			exit();
		}

		if (!pwdEqual($pwd,$pwd_repeat)) {
			header("location: ../signUp.php?error=wrongpwd");
			exit();  
		}
		
		

		
		createUser($pdo,$name,$email,$pwd,$pwd_repeat);
	
	}else
	{
		header('location: ../signUp.php');
	}
	
?>