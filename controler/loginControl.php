<?php
	if (isset($_POST['submit'])) {
		include '../model/user_function_db.php';
		$user_login = mysqli_real_escape_string($conn, $_POST['login']);
		$user_password = mysqli_real_escape_string($conn, $_POST['password']);
		if ($user_login != "" && $user_password != "") {
			$user = authUser($user_login);
			if ($user and $user['user_login']) {
				$user_id = $user['id'];
				$user_finded_login = $user['user_login'];
				$user_finded_password = $user['user_password'];
				$verifed_password = password_verify($user_password,$user_finded_password);
				if ($verifed_password) {
					$addToken_data = addToken($user_id);
					$token = $addToken_data['token'];
					$expDate = $addToken_data['date'];
					// $date = new DateTime();
					// $currentDate = $date->format('Y-m-d G:i:s');
					// echo $currentDate;
					setcookie('user_token', "$token", time() + 3600 * 24 * 2, '/'); // ERROR ! expDate chi linum cookien dnel
					header('Location: ../view/home.php');
				} else {
					header('Location: ../view/login.php');
				}
			} else {
				header('Location: ../view/login.php');
			}
		} else {
			header('Location: ../view/login.php');
		}
	} else {
		header('Location: ../view/login.php');
	}
?>