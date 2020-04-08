<?php
	session_start();
	
	include "loggedin.php";
	
	$uid = $_SESSION["uid"];
	$admin = $_SESSION["admin"]; 
	$servername = "localhost";
	$dbUsername = "root";
	$password = "";
	$dbName = "test";

	$conn = mysqli_connect($servername,$dbUsername,$password,$dbName);
	$sql = "select title,body,img,postDate,users.username,posts.uid from posts, users where pid = ? and posts.uid = users.uid";
	$stmt = mysqli_prepare($conn,$sql);
	mysqli_stmt_bind_param($stmt,"i",$_GET["pid"]);
	mysqli_stmt_execute($stmt);

	$result = mysqli_stmt_get_result($stmt);
	$getData = mysqli_fetch_assoc($result);

	$title = $getData["title"];
	$desc = $getData["body"];
	$img = $getData["img"];
	$date = $getData["postDate"];
	$username = $getData["username"];
	$postOwner = $getData["uid"];

	$_SESSION["pid"] = $_GET["pid"];
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Leaf A Comment</title>
<link rel="stylesheet" href="css/reset.css">
<link rel="stylesheet" href="css/forall.css">
<link rel="stylesheet" href="css/viewPost.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="js/editPost.js"></script>
<style>
	#delete {margin-top: 2em;}
</style>
</head>
<body>
	<header>
		<img id="logo" alt="whoops" src="images/logo.png">
		<nav>
			<form id="search" method="get" action="search.php">
			<input type="text" name="search" placeholder="type in keyword"><button type="submit">search</button>
			</form>
			<ul>
				<li class="navButton"><a href="main.php"><button>Home</button></a></li>
				<li class="navButton"><a href="manageaccount.html"><button>Account</button></a></li>
				<li class="navButton"><a href= <?php if($_SESSION["loggedIn"]) {echo "\"logout.php\" ><button> Log Out </button>";} else {echo "\"login.html\" ><button>Log In</button>";} ?> </a></li>
			</ul>
			
			
		</nav>
	</header>
	<main>
		<article class="post">
			<?php 
				if($img != null)
				{
					echo "<img class='thumbnail' src= 'images\\userimg\\$img' >";
				}
			?>
			<div class="content">
				<form method="post" action="editPost2.php" id="form" enctype="multipart/form-data">
					<fieldset>
						<legend>Edit Post</legend>
						<label>Title</label>
						<input type="text" name="title" <?php echo " value='$title'";?> > <br><br>
						<label>Description</label><br>
						<textarea rows="5" cols="50" name="desc"><?php echo $desc;?></textarea> <br><br>
					</fieldset>
					<br>
					<button type="submit" id="submitEdit">Submit</button>
					<button type="button" id="cancelEdit">Cancel</button> <br><br><br><br>		
				</form>
				<button id="delete">Delete</button>
			</div>
		</article>
	</main>
	
	<footer>
		<nav>
			<ul>
				<li class="navButton"><a href="main.php"><button>Home</button></a></li>
				<li class="navButton"><a href="manageaccount.html"><button>Account</button></a></li>
				<li class="navButton"><a href= <?php if($_SESSION["loggedIn"]) {echo "\"logout.php\" ><button> Log Out </button>";} else {echo "\"login.html\" ><button>Log In</button>";} ?> </a></li>
			</ul>
		</nav>
		<p>2020 &copy; Leaf A Comment</p>
		<a href="#top">back to top</a></span></p>
	</footer>

</body>
</html>
