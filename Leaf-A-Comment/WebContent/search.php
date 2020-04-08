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
<link rel="stylesheet" href="css/search.css">
</head>
<body>
	<header id="top">
		<img id="logo" alt="whoops" src="images/logo.png">
		<nav>
			<ul>
				<li class="navButton"><a href="main.html"><button>Home</button></a></li>
				<li class="navButton"><a href="manageaccount.html"><button>Account</button></a></li>
				<li class="navButton"><a href="login.html"><button>Log In</button></a></li>
			</ul>	
		</nav>
	</header>
	
	<main>
		<p><a href="newPost.html" id=newPostButton><button>New Post</button></a>
		<form id="search" method="get" action="search.php">
			<input id="searchBar" type="text" name="search" placeholder="type in keyword"><button type="submit">Search</button>
		</form>
		</p>
		<br>

		<?php
			while($getData = mysqli_fetch_assoc($result))
			{
				$pid = $getData["pid"];
				$title = $getData["title"];
				$desc = $getData["body"];
				$img = $getData["img"];
				$date = $getData["postDate"];
				$username = $getData["username"];

				/*
				echo "\n<article class='post'>\n<img class='thumbnail' src='images/$img'>\n<div class='content'>\n<h1>$title</h1>";
				echo "<p class='desc'>$desc</p>\n</div>\n<p class='things'>\n<time datetime='$date'>$date</time><br>";
				echo "<a href='viewpost.php?pid=$pid' class='commentButton'><button> View</button></a>\n</p>\n</article>\n";*/
			}
			mysqli_close($conn); 

		?>
		
		<article class='post'>
			<img class='thumbnail' src='images/leaf2.jpg'>
			<div class='content'>
				<h1>
					test
				</h1>
				<p class='desc'>
					test
				</p>
			</div>
			<p class='things'>
				<time datetime='2017-11-11'>2017-11-11</time><br>
				<a href='viewpost.php?pid=3' class='commentButton'><button> View</button></a>
			</p>
		</article>

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
	
