<?php 
	if (isset($_SESSION["loggedIn"])) {
	    unset($_SESSION["loggedIn"]);
	}
	
	header("Location: main.php");
	exit;
?>
