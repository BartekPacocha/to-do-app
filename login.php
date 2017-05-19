<?php
ob_start();

require_once 'app/init.php';


$login = $_POST['login-input'];
$pass = $_POST['password'];
$pass_hash = md5($pass);

$checkUser = $db->prepare("
	SELECT *
	FROM users
	WHERE login = '$login'
");

$checkUser->execute();
$count = $checkUser->rowCount();
$userRow = $checkUser->fetch(PDO::FETCH_ASSOC);

if ($count > 0) {
	if ($pass_hash == $userRow['password']) {
		$_SESSION['user_id'] = $userRow['id'];
		$_SESSION['username'] = $login;
		header('Location: index.php?i=0');
	}	else {
		header('Location: index.php?i=haslo');
	}	
} else {
	header('Location: index.php?i=login');
}


