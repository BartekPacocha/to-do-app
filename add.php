<?php
	
require_once 'app/init.php';

	

if(isset($_POST['name'])) {
	$name = trim($_POST['name']);
	$group = $_POST['groups'];

	if(!empty($name)) {
		$addedQuery = $db->prepare("
			INSERT INTO items (name, user, done, created)
			VALUES (:name, :user, 0, NOW())
		");

		$addedQuery->execute([
			'name' => $name,
			'user' => $_SESSION['user_id']
			//'group' => $group
		]);
	}
} 



header('Location: index.php');