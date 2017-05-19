<?php
	
require_once 'app/init.php';

if (isset($_POST['check-yes'])) {
	$moveQuery = $db->prepare("
		INSERT INTO deleteditems (id_item, name, user, done, created)
		SELECT id, name, user, done, created
		FROM items 
		WHERE done = 1
	");

	$moveQuery->execute();

	$deleteQuery = $db->prepare("
		DELETE FROM items
		WHERE done = 1
	");

	$deleteQuery->execute();
		
}

header('Location: index.php');