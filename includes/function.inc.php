<?php
	function emptyField($fields){
		$result=false;
		foreach ($fields as $field){
			if (empty($field)){
				$result=true;
				break;
			}
		}
		return $result;
	}
	
	function existUser($pdo,$email){
		$result=false;
		$sql="SELECT * FROM users WHERE UsersEmail = ?;";
		$stmt=$pdo->prepare($sql);
		$stmt->execute([$email]);
		
		if ($stmt){
				if ($stmt->rowCount() === 0){
					return $result;
				} else{
					$result=true;
					return $result;
				}
		}
	}


	function existName($pdo,$name){
		$result=false;
		$sql="SELECT * FROM users WHERE usersName = ?;";
		$stmt=$pdo->prepare($sql);
		$stmt->execute([$name]);
		
		if ($stmt){
				if ($stmt->rowCount() === 0){
					return $result;
				} else{
					$result=true;
					return $result;
				}
		}
	}
		
	function createUser($pdo,$name,$email, $pwd, $pwd_repeat){
		$sql="INSERT INTO users (usersName, UsersEmail, usersPwd)
		VALUES (?,?,?);";
		try{
			$stmt=$pdo->prepare($sql);
			
			$hashPwd=password_hash($pwd, PASSWORD_DEFAULT);
			$stmt->execute([$name,$email,$hashPwd]);
			header("location: ../signUp.php?error=none");
			exit();
			
		} catch(PDOException $e){
			header("location: ../signUp.php?error=stmt&message=".$e->getMessage());
			echo $e->getMessage();
			exit();
		}
	}

	function createTodo($pdo,$name){
		
		
		
	}

	function isMail($email){
		$result = true;
		if (filter_var($email, FILTER_VALIDATE_EMAIL)){
			$result = false;
		}
		return $result;
	}

	function pwdEqual($pwd,$pwd_repeat) {
		$result = false;
		if ($pwd === $pwd_repeat) {
			$result = true;
		}
		return $result;
	
		
	}

	function checkUser($pdo, $name){
		$sql = "SELECT * FROM users WHERE usersName = ?";

		$stmt = $pdo->prepare($sql);
		$stmt -> execute([$name]);
	
		
		$row = $stmt->fetch(PDO::FETCH_LAZY);
		return $row;
	}

	function loginUser($pdo, $name, $pwd) {
		$nameExist = existName($pdo,  $name);
		if ($nameExist === false) {
			header("location: ../login.php?error=wronglogin");
			exit();  
	
		} 
		$rows = checkUser($pdo, $name);
		$checkPwd = password_verify($pwd, $rows['usersPwd']);
	
		if ($checkPwd === false)  {
			header("location: ../login.php?error=wrongpwd");
			exit();  
	
		}
		else if ($checkPwd === true) {
			session_start();
		
			$_SESSION['name'] = $name;
			//$_SESSION['pwd'] = $pwd;
			header("location: ../index.php?ok=Yes");
			exit();
	
		}
	}


?>