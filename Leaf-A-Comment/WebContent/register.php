<?php include("process.php") ?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/reset.css">
<link rel="stylesheet" href="css/forall.css">
<link rel="stylesheet" href="css/login.css">

<title>Register</title>
</head>
<body>
	<header id="top">
	
		<img id="logo" alt="whoops" src="images/logo.png">
		
		<form id="search" method="get" action="search.php">
			<input type="text" name="search" placeholder="type in keyword"><button type="submit">search</button>
		</form>
		
		<nav>
			<ul>
				<li class="navButton"><a href="main.html"><button>Home</button></a></li>
			</ul>
		</nav>
		
	</header>
	
	<main>
	
		<h1>hi! please fill in the information below to create an account. thanks!</h1>
	
		<form name="signup" method="post" action="register.php"> 
		<!--onsubmit??? -->
		
			<fieldset>
			
				<p id="firstname">
					<label>first name:</label>
					<input type="text" name="firstname" value="<?php echo $firstname;?>" required>
				</p>
				
				<p id="lastname">
					<label>last name:</label>
					<input type="text" name="lastname" value="<?php echo $lastname;?>" required>
				</p>
				
				<p id="username">
					<label>username:</label>
					<input type="text" name="username" value="<?php echo $username;?>" required>
				</p>
				
				<p id="email">
					<label>email:</label>
					<input type="email" name="email" value="<?php echo $email;?>" required>
				</p>
				
				<p id="password">
					<label>password:</label>
					<input type="password" name="password" value="<?php echo $password;?>" required>
				</p>
				
				<p id="repassword">
					<label>retype password:</label>
					<input type="password" name="repassword" required>
				</p>
				
				<button type="submit">signup</button>
				<button type="reset">reset</button>
			
			</fieldset>
		
		</form>
	
	</main>
	
	<footer>
		<p>2020 &copy; Leaf A Comment</p>
		<a href="#top">back to top</a></span></p>
	</footer>

</body>
</html>

