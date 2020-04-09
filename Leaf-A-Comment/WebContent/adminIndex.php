<?php
	session_start();
	
	if (!isset($_SESSION["admin"])){
	   header("Location: main.php");
	   exit;
	}

	$servername = "localhost";
	$dbUsername = "root";
	$password = "";
	$dbName = "test";
	$keyword = null;

	if (isset($_REQUEST["usersearch"])){
	    $keyword = $_REQUEST["usersearch"];
	}
	if (is_null($keyword))
	{
		$keyword = "%%";
	}
	else
	{
		$keyword = "%".$keyword."%";
	}

	$conn = mysqli_connect($servername,$dbUsername,$password,$dbName);
	$sql = "select * FROM users where username like '$keyword'";
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
</head>
<body>
	<header id="top">
		<img id="logo" alt="whoops" src="images/logo.png">
		<nav>
			<ul>
				<li class="navButton"><a href="main.php"><button>Home</button></a></li>
				<li class="navButton"><a href="manageaccount.html"><button>Account</button></a></li>
				<li class="navButton"><a href="logout.php"><button>Log Out</button></a></li>
				<li class="navButton"><a href="report.html"><button>Report</button></a></li>
			</ul>	
		</nav>
	</header>
	
	<main>
		<p>
		<form id="anotherSearch" method="get" action="adminIndex.php">
			<button type="submit">Search User</button><input id="searchBar" type="text" name="usersearch" placeholder="type in username">
		</form>
		</p>
		</br>	
		
		<?php
			while($getData = mysqli_fetch_assoc($result))
			{
				$username = $getData["username"];
				$uid = $getData["uid"];
				echo "<p>";
				echo "<a href='deleteUser.php?uid=".$uid."'>Remove</a>";
				echo " ".$username;
				
				$admintrue = False;
				$sql2 = "SELECT * FROM  admins";
				
				if($result2 = $conn -> query($sql2)) {
				    while($fieldinfo = $result2 -> fetch_assoc()) {
				        $d = $fieldinfo["uid"];
				        if ($uid == $d){
				            $admintrue = True;
				        }
				    } $result2 -> free_result();
				} if ($admintrue == False){
				    echo " <a href='makeAdmin.php?uid=".$uid."'>Grant Admin Privileges</a></p>";
				} else {
				    echo " <a href='unmakeAdmin.php?uid=".$uid."'>Revoke Admin Privileges</a></p>";
				}
				
			}
			mysqli_close($conn); 

		?>

	</main>
	
	<footer>
		<nav>
			<ul>
				<li class="navButton"><a href="main.php">Home</a></li>
				<li class="navButton"><a href="manageaccount.html">Account</a></li>
				<li class="navButton"><a href="logout.php">Log Out</a></li>
				<li class="navButton"><a href="report.html">Report</a></li>
			</ul>
		</nav>
		<p>2020 &copy; Leaf A Comment</p>
		<a href="#top">back to top</a></span></p>
	</footer>
</body>
</html>

