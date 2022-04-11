<?php
	if (isset($_POST['submit'])) {
		$name=$_POST['name'];
		$pwd=$_POST['pwd'];
		
		require_once 'dbpdoconnection.inc.php';
		require_once 'function.inc.php';
		
		loginUser($pdo, $name, $pwd);
	
	}else
	{
		header('location: ../login.php');
	}
	
?>