<?php
	session_start();

	$uid = 1;
	$servername = "localhost";
	$dbUsername = "root";
	$password = "";
	$dbName = "test";

	$body = $_REQUEST["desc"];
	$parent = $_REQUEST["parent"];
	$pid = $_REQUEST["pid"];

	$conn = mysqli_connect($servername,$dbUsername,$password,$dbName);

	if ($parent != 0)
	{
		
		$sql = "select depth from comments where cid = ?;";
		$stmt = mysqli_prepare($conn,$sql);
		mysqli_stmt_bind_param($stmt,"i",$parent);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$getData = mysqli_fetch_assoc($result);
		$depth = $getData["depth"]+1;

		$sql = "insert into comments(pid,uid,parent,body,depth) values (?,?,?,?,?);";
		$stmt = mysqli_prepare($conn,$sql);
		mysqli_stmt_bind_param($stmt,"iiisi",$pid,$uid,$parent,$body,$depth);
		mysqli_stmt_execute($stmt);
	}
	else
	{
		$sql = "insert into comments(pid,uid,parent,body) values (?,?,?,?);";
		$stmt = mysqli_prepare($conn,$sql);
		mysqli_stmt_bind_param($stmt,"iiis",$pid,$uid,$parent,$body);
		mysqli_stmt_execute($stmt);
	}
	
	$sql = "select numComment from posts where pid = ?";
	$stmt = mysqli_prepare($conn,$sql);
	mysqli_stmt_bind_param($stmt,"i",$pid);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	$getData = mysqli_fetch_assoc($result);
	$numComm = $getData["numComment"];
	$numComm = $numComm+1;

	$sql = "alter table posts set numComment = ? where pid = ?";
	$stmt = mysqli_prepare($conn,$sql);
	mysqli_stmt_bind_param($stmt,"ii",$numComm,$pid);
	mysqli_stmt_execute($stmt);

	header("Location: viewPost.php?pid=$pid"); 

?>