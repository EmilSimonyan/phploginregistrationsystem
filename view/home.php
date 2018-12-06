<?php
	session_start();
	include '../model/user_function_db.php';
	include '../model/posts_function_db.php';
	if ($_COOKIE['user_token']) {
		$result = checkToken($_COOKIE['user_token']);
		$user_id = $result['user_id'];
		if ($result['isSuccess'] == 1) {
			$user_login = getUser($result['user_id']);
			$_SESSION['user_id'] = $user_id;
		} else {
			header('Location: login.php');
		}
	} else {
		header('Location: login.php');
	}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="./public/css/posts.css">
    <title>Welcome Home Page</title>
  </head>
  <body>
	<div class="container">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			  <a class="navbar-brand" href="home.php">Home</a>
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			    <span class="navbar-toggler-icon"></span>
			  </button>
			  <div class="collapse navbar-collapse" id="navbarNav">
			    <ul class="navbar-nav ml-auto">
			      <li class="nav-item active">
			        <a class="nav-link btn-warning"><u><?php echo "Welcome - ". $user_login ?></u></a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link btn-danger" href="../controler/logout.php">Logout</a>
			      </li>
			    </ul>
			  </div>
	     </nav>
	     <section class="mt-4">
	     	<div class="container">
	     		<div class="row">
	     			<div class="col-12 col-md-6 col-sm-6 col-xl-6 my-f-block p-3 shadow-lg">
	     				<h4>Add Post</h4>
	     				<form action="#" method="post">
	     					<div class="form-group">
							    <label for="posttitle">Post title</label>
							    <input type="text" class="form-control" id="posttitle" placeholder="Enter Post Title" name="post_title">
						  	</div>
						  	<div class="form-group">
							    <label for="postdescript">Post Description</label>
							    <textarea class="form-control" id="postdescript" name="post_descript" rows="3" placeholder="Enter Post Description"></textarea>
						  	</div>
						  	<input type="submit" class="btn btn-outline-success" value="Add Post">
	     				</form>
	     			</div>
	     		</div>
	     		<div class="row mt-2">
	     			<div class="col-12 col-md-6 col-sm-6 col-xl-6"></div>
	     			<div class="col-12 col-md-6 col-sm-6 col-xl-6 my-f-block p-3 shadow-lg">
	     				<h4>My Posts</h4>
	     				<hr>
	     				<?php 
	     				$resultRows = getMyPosts($_SESSION['user_id']);
						foreach ($resultRows as $row) {
							$id = $row['id'];
							$postTitle = $row['post_title'];
							$postDesc = $row['post_desc'];
							echo "<div id=".$id.">";
							echo "<h5>".$postTitle."</h5>";
							echo "<p class='lead'>".$postDesc."</p>";
							echo "</div>";
							echo "<hr>";
	     				}	     				
	     				?>
	     			</div>
	     		</div>
	     		<div class="row mt-2">
	     			<div class="col-12 col-md-12 col-sm-12 col-xl-12 my-f-block p-3 shadow-lg">
	     				<h4>All Posts</h4>
	     				<hr>
	     				<?php 
	     				$resultRows = getAllPosts();
						foreach ($resultRows as $row) {
							$id = $row['id'];
							$postTitle = $row['post_title'];
							$postDesc = $row['post_desc'];
							echo "<div id=".$id.">";
							if ($_SESSION['user_id'] == $row['user_id']) {
								echo "<p>----MY----</p>";
							}
							echo "<h5>".$postTitle."</h5>";
							echo "<p class='lead'>".$postDesc."</p>";
							echo "</div>";
							echo "<hr>";
	     				}	     				
	     				?>
	     			</div>
	     		</div>
	     	</div>
	     </section>
	</div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>