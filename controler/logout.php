<?php
	session_start();
	include '../model/user_function_db.php';
	if ($_COOKIE['user_token'] and $_SESSION['user_id']) {
		$result = removeToken($_SESSION['user_id'],$_COOKIE['user_token']);
		if ($result === 1) {
			setcookie('user_token', '', time() - 1, '/');
			unset($_SESSION['user_id']);
			header('Location: ../view/login.php');
		}
	} else {
		echo "Error";
	}
?>