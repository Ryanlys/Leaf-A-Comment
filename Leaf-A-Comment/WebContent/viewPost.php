<?php
	session_start();
	if (isset($_SESSION["uid"])) {
    	$uid = $_SESSION["uid"];
	}
	if (isset($_SESSION["admin"]))
	{
		$admin = true;
	}
	else
	{
		$admin = false;
	}
	
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
	$datetime = $getData["postDate"];
	$date = substr($datetime, 0,10);
	$username = $getData["username"];
	$postOwner = $getData["uid"];

	$pid = $_GET["pid"];


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
<script type='text/javascript' src='js/viewPost.js'></script>;	
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
    	<?php 
    	   if (isset($_SESSION["loggedIn"])) {
    	       echo "<p><a href='newPost.html' id=newPostButton><button>New Post</button></a></p><br>";
    	   }
    	?>
    	<article class="post">
			<?php 
				if($img != null)
				{
					echo "<img class='thumbnail' src= 'images\\userimg\\$img' >";
				}
			?>
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
				<time datetime=<?php echo "'$datetime'>$date"?></time><br>
				<?php 
				
				if (isset($_SESSION["admin"])){
				    echo "<a href='adminIndex.php?usersearch=".$username."'>".$username."</a><br>";
				} else {
				    echo "<a href=\"\">$username</a><br>";
				}
				
				?>
			</p>
		</article>
		<?php
			if(isset($_SESSION["loggedIn"]) && ($uid == $postOwner || $admin == true))
			{
				echo "<section><button id='mainReply'> Reply </button> <a href='editPost.php?pid=$pid'><button id='editPost'> Edit </button></a></section>";
			}
		?>	
		<section class="comments">
			<?php
				$sql = "select body,parent,cid,commentDate,username,depth,comments.uid from comments, users where pid = ? and comments.uid = users.uid order by parent asc";
				$stmt = mysqli_prepare($conn,$sql);
				mysqli_stmt_bind_param($stmt,"i",$_GET["pid"]);
				mysqli_stmt_execute($stmt);

				$result = mysqli_stmt_get_result($stmt);

				while($getData = mysqli_fetch_assoc($result))
				{
					$body = $getData["body"];
					$date = $getData["commentDate"];
					$uname = $getData["username"];
					$cid = $getData["cid"];
					$depth = $getData["depth"];
					$parent = $getData["parent"];
					$commentOwner = $getData["uid"];

					if ($uid == $commentOwner)
					{
						echo "<div class='divComment'id='$cid' data-depth='$depth' data-parent='$parent'><p class='user'>$uname <time datetime='$date'>$date</time></p><br>";
						echo "<p class='comment'>$body</p><br><button class='replyButton'>Reply</button><button class='editComment'>Edit</button><br>";
						echo "<button class='collapse'>Collapse</button></div><br>";
					}
					else
					{
						echo "<div class='divComment'id='$cid' data-depth='$depth' data-parent='$parent'><p class='user'>$uname <time datetime='$date'>$date</time></p><br>";
						echo "<p class='comment'>$body</p><br><button class='replyButton'>Reply</button><br>";
						echo "<button class='collapse'>Collapse</button></div><br>";
					}
					
				};
			?>
		</section>

	</main>
	
	<footer>
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
		<p>2020 &copy; Leaf A Comment</p>
		<a href="#top">back to top</a></span></p>
	</footer>

</body>
</html>
