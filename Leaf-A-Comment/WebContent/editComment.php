<?php
	session_start();
	$servername = "localhost";
	$dbUsername = "root";
	$password = "";
	$dbName = "test";

	$body = $_REQUEST["desc"];
	$pid = $_REQUEST["pid"];
	$cid = $_REQUEST["cid"];

	$conn = mysqli_connect($servername,$dbUsername,$password,$dbName);
	$sql = "update comments set body = ? where cid = ?;";
	$stmt = mysqli_prepare($conn,$sql);
	mysqli_stmt_bind_param($stmt,"si",$body,$cid);
	mysqli_stmt_execute($stmt);

	header("Location: viewPost.php?pid=$pid");
?>