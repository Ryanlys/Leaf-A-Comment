<?php
session_start();

	$servername = "localhost";
	$dbUsername = "root";
	$password = "";
	$dbName = "test";
	$pid = $_REQUEST["pid"];

	$conn = mysqli_connect($servername,$dbUsername,$password,$dbName);
	$sql = "delete from posts where pid = ?";
	$stmt = mysqli_prepare($conn,$sql);
	mysqli_stmt_bind_param($stmt,"i",$pid);
	mysqli_stmt_execute($stmt);

	header("Location: main.html");
?>