<?php
	session_start();
	//$username = $_SESSION["username"];

	$uid = 1;
	$title = $_REQUEST["title"];
	$desc = $_REQUEST["desc"];

	$servername = "localhost";
	$dbUsername = "root";
	$password = "";
	$dbName = "test";

	$conn = mysqli_connect($servername,$dbUsername,$password,$dbName);

	if($conn)
	{
		echo "Connection successful \n";
	}
	else
	{
		die("Connection failed: ".mysqli_connect_error());
	} 

	$sql = "insert into posts(uid,numComment,title,body,postDate) values (?,?,?,?,?);";
	if($stmt = mysqli_prepare($conn,$sql))
	{
		$date = "\"".date("Y-m-d")."\"";
		echo "date is ".$date;
		$numCom = 0;
		mysqli_stmt_bind_param($stmt,'iissb',$uid,$numCom,$title,$desc,$date);
		mysqli_stmt_execute($stmt);

		$sql = "select last_insert_id()";
		$stmt = mysqli_prepare($conn,$sql);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$getData = mysqli_fetch_assoc($result);

		$postId = $getData["last_insert_id()"];
	}

	if (mysqli_query($conn,$sql))
	{}
	else
	{
		echo "Error: ".$sql."<br>".mysqli_error($conn);
	}
	
	$_SESSION["loggedIn"] = true;
	header("Location: viewPost.php?pid=$postId"); 
?>