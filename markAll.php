<?php

require_once 'app/init.php';

if (isset($_POST['mark-all'])) {
	$markQuery = $db->prepare("
		UPDATE items
		SET done = 1
		WHERE done = 0
	");

	$markQuery->execute();

} elseif ($_POST['unmark-all']) {
	$unmarkQuery = $db->prepare("
		UPDATE items
		SET done = 0
		WHERE done = 1
	");

	$unmarkQuery->execute();
}

header('Location: index.php');