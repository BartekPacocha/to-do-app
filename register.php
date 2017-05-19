<?php

require_once 'app/init.php';

$login = $_POST['login-input'];
$email = $_POST['email'];
$pass = $_POST['password'];
$pass_hash = md5($pass);

$checkUser = $db->prepare("
	SELECT *
	FROM users
	WHERE login = '$login'
");

$checkUser->execute();
$count = $checkUser->rowCount();

if ($count == 0) {
	$registerQuery = $db->prepare("
		INSERT INTO users (login, email, password)
		VALUES (:login, :email, :pass)
	");
		$registerQuery->execute([
		'login' => $login,
		'email' => $email,
		'pass' => $pass_hash
	]);
}

header('Location: index.php?i=0');