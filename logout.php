<?php

require_once 'app/init.php';

session_destroy();
unset($_SESSION['user_session']);

header('Location: index.php');