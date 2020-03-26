<?php
	session_start();
	$servername = "localhost";
	$dbUsername = "root";
	$password = "";
	$dbName = "test";

	$conn = mysqli_connect($servername,$dbUsername,$password,$dbName);
	$sql = "select title,body from posts where pid = ?";
	$stmt = mysqli_prepare($conn,$sql);
	mysqli_stmt_bind_param($stmt,"i",$_GET["pid"]);
	mysqli_stmt_execute($stmt);

	$result = mysqli_stmt_get_result($stmt);
	$getData = mysqli_fetch_assoc($result);

	$title = $getData["title"];
	$desc = $getData["body"];



?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Leaf A Comment</title>
<link rel="stylesheet" href="css/reset.css">
<link rel="stylesheet" href="css/forall.css">
<link rel="stylesheet" href="css/viewPost.css">
</head>
<body>
	<header>
		<img id="logo" alt="whoops" src="images/logo.png">
		<nav>
			<form id="search" method="get" action="search.php">
			<input type="text" name="search" placeholder="type in keyword"><button type="submit">search</button>
			</form>
			<ul>
				<li class="navButton"><a href="main.html"><button>Home</button></a></li>
				<li class="navButton"><a href="manageaccount.html"><button>Account</button></a></li>
				<li class="navButton"><a href= <?php if($_SESSION["loggedIn"]) {echo "\"logout.php\" ><button>Log Out</button>";} else {echo "\"login.html\" ><button>Log In</button>";}</a></li>
			</ul>
			
			
		</nav>
	</header>
	<main>
		<p><a href="newPost.html" id=newPostButton><button>New Post</button></a></p><br>
		<article class="post">
			<img class="thumbnail" src="images/leaf.jpg">
			<div class="content">
				<h1>
					<?php
						echo $title;
					?>
				</h1>
				<p class="desc" id="description">
					<?php
						echo $desc;
					?>
				</p>
			</div>
			<p class="things">
				<time datetime="2020-02-16">2020/2/16</time><br>
			</p>
		</article>
		
		<section class="comments">
			<div>
				<p class="user">Bob the Builder <time datetime="2020-02-17">2020/2/17</time></p>
				<p class="comment"> Wow amazing. </p>
			</div>

		</section>

	</main>
	
	<footer>
		<nav>
			<ul>
				<li class="navButton"><a href="main.html">Home</a></li>
				<li class="navButton"><a href="account.html">Account</a></li>
				<li class="navButton"><a href="login.html">Log In</a></li>
			</ul>
		</nav>
		<p>2020 &copy; Leaf A Comment</p>
		<a href="#top">back to top</a></span></p>
	</footer>

</body>
</html>