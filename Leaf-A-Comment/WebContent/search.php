<?php
	session_start();

	$servername = "localhost";
	$dbUsername = "root";
	$password = "";
	$dbName = "test";

	$keyword = $_REQUEST["search"];
	if (is_null($keyword))
	{
		$keyword = "%%";
	}
	else
	{
		$keyword = "%".$keyword."%";
	}

	$conn = mysqli_connect($servername,$dbUsername,$password,$dbName);
	$sql = "select pid,title,body,img,postDate,users.username from posts, users where posts.uid = users.uid and title like '$keyword'";
	$result = mysqli_query($conn,$sql);
	

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Leaf A Comment</title>
<link rel="stylesheet" href="css/reset.css">
<link rel="stylesheet" href="css/forall.css">
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="css/search.css">
</head>
<body>
	<header id="top">
		<img id="logo" alt="whoops" src="images/logo.png">
		<nav>
			<ul>
				<li class="navButton"><a href="main.php"><button>Home</button></a></li>
				<?php 
					if (!(isset($_SESSION["loggedIn"]))) {
	    				echo "<li class='navButton'><a href='login.html'><button>Log In</button></a></li>";
					} else {
					    echo "<li class='navButton'><a href='manageaccount.html'><button>Account</button></a></li>";
					    echo "<li class='navButton'><a href='logout.php'><button>Log Out</button></a></li>";
					}
				?>
			</ul>	
		</nav>
	</header>
	
	<main>
		<p>
		<form id="anotherSearch" method="get" action="search.php">
			<button type="submit">Search</button><input id="anotherSearchBar" type="text" name="search" placeholder="type in keyword">
		</form>
		</p>
		<?php 
    	   if (isset($_SESSION["loggedIn"])) {
    	       echo "<p><a href='newPost.html' id=newPostButton><button>New Post</button></a></p><br>";
    	   }
    	?>
		<br>

		<?php
			while($getData = mysqli_fetch_assoc($result))
			{
				$pid = $getData["pid"];
				$title = $getData["title"];
				$desc = $getData["body"];
				$img = $getData["img"];
				$datetime = $getData["postDate"];
				$username = $getData["username"];
				$date = substr($datetime, 0,10);
				
				echo "\n<article class='post'>\n<img class='thumbnail' src='images\\userimg\\".$img."'>\n<div class='content'>\n<h1>".$title."</h1>";
				echo "<p class='desc'>".$desc."</p>\n</div>\n<p class='things'>\n<time datetime='".$datetime."'>".$date."</time><br>";
				echo "<a href='viewPost.php?pid=".$pid."' class='commentButton'><button> View</button></a>\n</p>\n</article>\n";
			}
			mysqli_close($conn); 

		?>

	</main>
	
	<footer>
		<nav>
			<ul>
				<li class="navButton"><a href="main.php">Home</a></li>
				<?php 
					if (!(isset($_SESSION["loggedIn"]))) {
	    				echo "<li class='navButton'><a href='login.html'>Log In</a></li>";
					} else {
					    echo "<li class='navButton'><a href='manageaccount.html'>Account</a></li>";
					    echo "<li class='navButton'><a href='logout.php'>Log Out</a></li>";
					}
				?>
			</ul>
		</nav>
		<p>2020 &copy; Leaf A Comment</p>
		<a href="#top">back to top</a></span></p>
	</footer>
</body>
</html>
	
