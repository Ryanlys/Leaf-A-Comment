<?php
	session_start();
	
	include "loggedin.php";
	
	$servername = "localhost";
	$dbUsername = "root";
	$password = "";
	$dbName = "test";

	$body = $_REQUEST["desc"];
	$pid = $_REQUEST["pid"];
	$title = $_REQUEST["title"];

	$conn = mysqli_connect($servername,$dbUsername,$password,$dbName);
	$sql = "update posts set body = ?, title = ? where pid = ?;";
	$stmt = mysqli_prepare($conn,$sql);
	mysqli_stmt_bind_param($stmt,"ssi",$body,$title,$pid);
	mysqli_stmt_execute($stmt);

	header("Location: viewPost.php?pid=$pid");
?>