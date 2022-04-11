<?php
	require_once 'header_1.php';
?>


<?php
	require_once 'includes/dbpdoconnection.inc.php';

	session_start();
	

	$itemsQuery = $pdo->prepare("
		SELECT id, todoName, done
		FROM items
		WHERE userName = :userName
	");

	$itemsQuery->execute([
		'userName' => $_SESSION['name']
	]);

	$items = $itemsQuery->rowCount() ? $itemsQuery : [];

	$db = mysqli_connect("localhost", "root", "", "todo_project1");
	require_once 'includes/dbpdoconnection.inc.php';

	if (isset($_GET['del_task'])) {
		$id = $_GET['del_task'];
	
		mysqli_query($db, "DELETE FROM items WHERE id=".$id);
		header('location: index.php');
	}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset = "UTF-8">
		<link rel="stylesheet" href="includes/style.css">
	</head>
	<body>

	<div class="card">

		<div class="list">
		<?php
			require_once 'includes/dbpdoconnection.inc.php';

			if (isset($_SESSION["name"])){
				echo "user: ". $_SESSION["name"];
			}
			else{
				header("location:login.php");
			}
		?>
			
			<h1 style="text-align: center;"> To do</h1>

			<?php if(!empty($items)): ?>
			<ul class="items">
				<?php foreach($items as $item): ?>
					<li style="display: flex;
						flex-direction: row;"> 

						<span class="item<?php echo $item['done'] ? ' done' : '' ?>"><?php echo $item['todoName']; ?></span>
						<div style="padding-left:30px; right: 570px; position: absolute;">
							<?php if(!$item['done']): ?>
								<a href="includes/mark.php?as=done&item=<?php echo $item['id']; ?>" class="done-button">Mark as done</a>
							<?php else: ?>
								<a href="includes/mark.php?as=undone&item=<?php echo $item['id']; ?>" class="done-button">Mark as undone</a>
							<?php endif; ?>
							
								<a href="index.php?del_task=<?php echo $item['id'] ?>" class="delete-button">X</a>
						</div>
						
					</li>
				<?php endforeach; ?>
				
			
				
			</ul>
			<?php else: ?>
				<p>Your haven't added any items yet.</p>
			<?php endif; ?>
			<form class="item-add" action="includes/add.php" method="post">
				<input type="text" name="name_todo" 
				placeholder="Type a new item here" class="input" autocomplete="off"
				required maxlength=15>
				<input type="submit" value="Add" class="submit">
			</form>

			<div style="margin-top: 20px;
	text-align: center;">
				<a href="logout.php">Logout</a>
			</div>

		</div>

	</div>
	</body>
</html>

<?php
	require_once 'footer.php';
?>