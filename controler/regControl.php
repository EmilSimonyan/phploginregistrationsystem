<?php
	if (isset($_POST['submit'])) {
		include '../model/user_function_db.php';
		$user_login = mysqli_real_escape_string($conn, $_POST['login']);
		$user_password = mysqli_real_escape_string($conn, $_POST['password']);
		if ($user_login != "" && $user_password != "") {
			$hash_password = password_hash($user_login, PASSWORD_DEFAULT);
			$user_result = insertUser($user_login, $hash_password);
			if ($user_result === 1) {
				header("Location: home.php");
			} else {
				header('Location: ../view/registration.php');
			}
		}
	} else {
		header('Location: ../view/registration.php');
	}
?>