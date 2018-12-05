<?php
	include "database.php";
	define('DAYS', 2);
	
	function insertUser ($user_login, $user_password) {
		global $conn;
		$query = "INSERT into tbl_users (user_login, user_password) VALUES ('$user_login', '$user_password')";
		$res = mysqli_query($conn,$query);
		if (!$res) {
			return 0;
			die(mysqli_error($conn));
		} else {
			return 1;
		}
	}
	function authUser ($user_login) {
		global $conn;
		$query = "SELECT * FROM tbl_users WHERE `user_login` = '$user_login'";
		$res = mysqli_query($conn,$query);
		if (!$res) {
			return 0;
			die(mysqli_error($conn));
		} else {
			return mysqli_fetch_all($res,MYSQLI_ASSOC)[0];
		}
	}

	function addToken ($user_id) {
		global $conn;
		$token = uniqid();
		$date = new DateTime();
		$date->setDate(2019, 2, 3 + DAYS); // ERROR! chilinum dnel esorvany menak oryin gumares DAYS
		$expDate = $date->format('Y-m-d G:i:s');
		// echo $date->format('Y-m-d G:i:s');
		$query = "INSERT INTO tbl_tokens (user_id, token, expDate) VALUES ('$user_id', '$token', '$expDate')";
		$res = mysqli_query($conn, $query);
		if (!$res) {
			return 0;
		} else {
			return array('date' => $expDate, 'token' => $token);
		}	
	}

	function checkToken ($token) {
		global $conn;
		$query = "SELECT * FROM tbl_tokens WHERE token = '$token'";
		$res = mysqli_query($conn, $query);
		if (!$res)die(mysqli_error($conn));
		$findedToken = mysqli_fetch_all($res,MYSQLI_ASSOC)[0];
		if (!$findedToken) {
			return array('isSuccess' => false, 'msg' => 'Error! Invalid Token');
		}
		elseif ($findedToken and count($findedToken) > 0) {
			$date = new DateTime();
			$findedToken_userID = $findedToken['user_id'];
			$currentDate = $date->format('Y-m-d G:i:s');
			$findedToken_expDate = $findedToken['expDate'];
			if ($currentDate > $findedToken_expDate) {
				return array('isSuccess' => false, 'msg' => 'Error! Exp Date is Over.');
			}
			return array('user_id' => $findedToken_userID, 'isSuccess' => true);
		}
	}

	function getUser($user_id) {
		global $conn;
		$query = "SELECT * FROM tbl_users WHERE id = '$user_id'";
		$res = mysqli_query($conn,$query);
		if (!$res)die(mysqli_error($conn));
		return mysqli_fetch_all($res,MYSQLI_ASSOC)[0]['user_login'];
	}

	function removeToken ($user_id, $token) {
		global $conn;
		// 
	}
?>