<?php
	require_once 'app/init.php';
	
	if (isset($_GET['i'])) {
		$info = $_GET['i'];
	} else {
		$info = null;
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>TO DO</title>

	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Shadows+Into+Light" rel="stylesheet">
	<link rel="stylesheet" href="css/main.css">

	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	<script src="js/script.js"></script>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>

<!-- Form when logged -->

<?php 
	if(isset($_SESSION['user_id'])):


	$itemsQuery = $db->prepare("
		SELECT id, name, done
		FROM items
		WHERE user = :user
	");

$itemsQuery->execute([
	'user' => $_SESSION['user_id']
]);

$items = $itemsQuery->rowCount() ? $itemsQuery : [];

?>

	<div class="list">

	<div class="panel">
		<div class="panel-name">
			<h3 id="name">Hello, <?php echo $_SESSION['username']; ?></h3>
		</div>
		<div class="panel-logout">
			<form action="logout.php" method="post">
				<input type="submit" class="panel-submit" value="Logout">
			</form>
		</div>
		
	</div>

		<h1 class="header">To do:</h1>

		<?php if(!empty($items)):?>

		<ul class="items">
			<?php foreach($items as $item): ?>
				<li>
					<span class="item <?php echo $item['done'] ? ' done' : '' ?>"><?php echo $item['name']?></span>
					<?php if(!$item['done']): ?>
						<a href="mark.php?as=done&item=<?php echo $item['id']?>" class="done-button">Done</a>
					<?php else: ?>
						<a href="mark.php?as=notdone&item=<?php echo $item['id']?>" class="done-button">TO DO</a>
					<?php endif; ?>
				</li>
			<?php endforeach ?>
		</ul>

		<?php else: ?>
			<p>You haven't added any items yet</p>
		<?php endif; ?>

		<form class="item-add" action="add.php" method="post">
			<input type="text" name="name" placeholder="Type a new item" class="input" autocomplete="off" required>
			
<!--
			<select name="groups" id="groups-select">
				<option value="Shopping">Shopping</option>
				<option value="School">School</option>
				<option value="Private">Private</option>
			</select>
-->

			<input type="submit" value="Add" class="submit">	
		</form>

		<form class="item-mark" action="markAll.php" method="post" >
			<input type="submit" value="Mark all as done" class="mark" name="mark-all">
			<input type="submit" value="Mark all as TO DO" class="mark" name="unmark-all">
		</form>

		<form class="item-delete" action="delete.php" method="post">
			<p class="question">Do you want to delete all done tasks?
				<input type="checkbox" id="check-yes" name="check-yes" value="yes">
				<label for="check-yes">YES</label>
			</p>
			<input type="submit" value="Delete" class="delete-done visible">
		</form>

	</div>

<!-- Form when not logged -->

<?php else: ?>

<div class="login">
		<h1 class="header">Sign In:</h1>
		
		<form class="item-login" action="login.php" method="post" >
			<h3>Login: </h3> 
				<input type="text" class="input" name="login-input" placeholder="<?php
					if ($info == 'login') {
						echo 'incorrect login';
					}
				 ?>">
			<h3>Password:</h3> 
				<input type="password" class="input input-password" name="password" placeholder="<?php
					if ($info == 'haslo') {
						echo 'incorrect password';
					}
				 ?>">
				<input type="submit" value="Login" class="submit" name="login">
		</form>

		<p class="question">Want to register?
			<input type="checkbox" id="check-yes" name="check-yes" value="yes">
			<label for="check-yes">YES</label>
		</p>
				

		<form class="item-register visible" action="register.php" method="post">
			<h3>Login: </h3> 
				<input type="text" class="input" name="login-input">
			<h3>E-mail:</h3>
				<input type="email" class="input" name="email">
			<h3>Password:</h3> 
				<input type="password" class="input" name="password">
			<input type="submit" value="Register" class="delete-done" name="register">
		</form>
		

</div>


<?php endif; ?>

</body>
</html>