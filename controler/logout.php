<?php
	session_start();
	if ($_COOKIE['user_token'] and $_SESSION['user_id']) {
		setcookie('user_token', '', time() - 1, '/');
		unset($_SESSION['user_id']);
		header('Location: ../view/login.php');
	} else {
		echo "Error";
	}
?>