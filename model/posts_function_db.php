<?php
	include "database.php";
	
	function getMyPosts ($user_id) {
		global $conn;
		$query = "SELECT * FROM tbl_posts WHERE `user_id` = '$user_id'";
		$res = mysqli_query($conn,$query);
		return mysqli_fetch_all($res,MYSQLI_ASSOC);
	}	

	function getAllPosts () {
		global $conn;
		$query = "SELECT * FROM tbl_posts";
		$res = mysqli_query($conn,$query);
		return mysqli_fetch_all($res,MYSQLI_ASSOC);
	}	
?>