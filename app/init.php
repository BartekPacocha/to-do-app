<?php

session_start();

$_SESSION['user_id'] = 1;

$db = new PDO('mysql:host=localhost;dbname=todo', 'root', '');

if(!isset($_SESSION['user_id'])) {
	die('you are not logged in');
}