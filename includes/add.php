<?php

    require_once 'dbpdoconnection.inc.php';
    session_start();
	if(isset($_POST['name_todo'])){
        $name_todo = trim($_POST['name_todo']);

		if(!empty($name_todo)){
			$addedQuery = $pdo->prepare("
                INSERT INTO items (todoName, userName, done)
                VALUES (:todoName, :userName, 0)
            ");

            $addedQuery->execute([
                'todoName' => $name_todo,
                'userName' => $_SESSION['name']
            ]);
		}

		
    }

    header('location: ../index.php');
	
?>