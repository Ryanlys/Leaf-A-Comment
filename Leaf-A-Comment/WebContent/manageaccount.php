<?php
	session_start();
	$profileID = $_REQUEST["id"];

	$servername = "localhost";
	$dbUsername = "root";
	$password = "";
	$dbName = "test";

	$conn = mysqli_connect($servername,$dbUsername,$password,$dbName);
	$sql = "select firstname, lastname, pp, bio from users where uid = ?";
	$stmt = mysqli_prepare($conn,$sql);
	mysqli_stmt_bind_param($stmt,"i",$profileID);
	mysqli_stmt_execute($stmt);

	$result = mysqli_stmt_get_result($stmt);
	$getData = mysqli_fetch_assoc($result);

	$fname = $getData["firstname"];
	$lname = $getData["lastname"];
	$path = $getData["pp"];
	$bio = $getData["bio"];
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/reset.css">
<link rel="stylesheet" href="css/forall.css">
<link rel="stylesheet" href="css/login.css">
<script type="text/javascript">

	function validateForm(){
		
		var e = document.manage.newpassword.value;
		var f = document.manage.renewpassword.value;
		
		if(e != f){
			alert("passwords don't match, please retype, thanks!");
			return false;
		} else{
			return true;
		}
	}

</script>
<title>manageaccount page</title>
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
				<li class="navButton"><a href="logout.php"><button>Logout</button></a></li>
			</ul>
		</nav>
		
	</header>
	
	<main>
		<?php

			echo "<img class='thumbnail' src='images\\userimg\\$path'>";
			echo "<div style='border: 2px solid #debead;'><h1> $fname $lname </h1></div><br>";
			echo "<div style='border: 2px solid #debead;'><p>$bio</p></div><br><br><br>";

			if($_SESSION["uid"] == $profileID)
			{

				echo "<h1>Anything you'd like to change?</h1>";
				echo "<form name='manage' method='post' action='manageaccountChanges.php' onSubmit='return validateForm()'>";
				echo "<fieldset><p id='firstname'><label>First Name:</label><input type='text' name='firstname'></p><br><br>";
				echo "<p id='lastname'><label>Last Name:</label><input type='text' name='lastname'></p><br><br>";
				echo "<p id='newpassword'><label>New Password:</label><input type='password' name='newpassword' pattern = '([A-z0-9]){7,14}''></p><br><br>";
				echo "<p id='repassword'><label>Retype New Password:</label><input type='password' name='renewpassword'></p><br><br>";
				echo "<p><label> Bio</label> <br><textarea id='bio' name='bio' rows='5' cols='50' style='background-color: white;'></textarea><br><br>";
				echo "<button type='submit'>change</button><button type='reset'>reset</button></fieldset></form>";
			}
		?>
		
	</main>
	<footer>
		<nav>
			<ul>
				<li class="navButton"><a href="main.php">Home</a></li>
				<li class="navButton"><a href="logout.php">Logout</a></li>
			</ul>
		</nav>
		<p>2020 &copy; Leaf A Comment</p>
		<a href="#top">back to top</a></p>
	</footer>

</body>
</html>