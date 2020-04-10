<?php 
session_start();

	if (isset($_SESSION["loggedIn"])) {
	    unset($_SESSION["loggedIn"]);
	    unset($_SESSION["uid"]);
	    unset($_SESSION["admin"]);
	    unset($_SESSION["enabled"]);
	    header("Location: main.php");
	    exit;
	} else
	    echo $_SESSION["loggedIn"];
?>
