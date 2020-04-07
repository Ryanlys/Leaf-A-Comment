<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/reset.css">
<link rel="stylesheet" href="css/forall.css">
<link rel="stylesheet" href="css/login.css">
<title>Email Reset</title>
</head>
<body>
	<header id="top">
	
		<img id="logo" alt="whoops" src="images/logo.png">
		
		<form id="search" method="get" action="search.php">
			<input type="text" name="search" placeholder="type in keyword"><button type="submit">search</button>
		</form>
		
		<nav>
			<ul>
				<li class="navButton"><a href="main.php"><button>Home</button></a></li>
			</ul>
		</nav>
		
	</header>

	<main>
		
		<h1>Hi, can we get your email?</h1>
		<form id="resetEmail" method="post" action="sendmail.php">
		
			<fieldset>
			
				<p id="email">
					<label>Email:</label>
					<input type="email" name="email" required>
				</p>
				
				<button type="submit">Reset</button>
			
			</fieldset>
		
		</form>
	
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
