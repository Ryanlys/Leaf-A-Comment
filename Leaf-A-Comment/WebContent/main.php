<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Leaf A Comment</title>
<link rel="stylesheet" href="css/reset.css">
<link rel="stylesheet" href="css/forall.css">
<link rel="stylesheet" href="css/main.css">
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
		  if (!(isset($_SESSION["loggedIn"]))) {
	    	echo "<p><a href='newPost.html' id=newPostButton><button>New Post</button></a></p><br>";
		  }
		
		$mysqli = new mysqli("localhost", "root","", "test");
		
		if($mysqli -> connect_errno){
		    die("Connection failed: " . $mysqli->connect_error);
		} 
		
		$sql = "SELECT * FROM posts";
		
		if($result = $mysqli -> query($sql)){
		    
		    while($fieldinfo = $result -> fetch_assoc()){
		        
		        $a = $fieldinfo["postDate"];
		        $b = $fieldinfo["title"];
		        $c = $fieldinfo["body"];
		        $d = $fieldinfo["img"];
		        
		        echo "<article class='post'><img class='thumbnail' src='".$d."'>";
                echo "<div class='content'><h1>".$b."</h1><p class='desc'>".$c."</p></div>";
			    echo "<p class='things'><time datetime='".$a."'>".$a."</time><br><a href='main.html' class='commentButton'><button>Comment</button></a></p></article>";
		
		    }
		}
        ?>
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
