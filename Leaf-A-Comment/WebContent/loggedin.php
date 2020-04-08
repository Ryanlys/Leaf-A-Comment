<?php 
	if (!(isset($_SESSION["loggedIn"]))) {
	    header("Location: login.html");
	    exit;
	}
?>