<?php
	session_start();

	$uid = 1; //to be removed
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

	$sql = "insert into posts(uid,numComment,title,body,img) values (?,?,?,?,?);";
	if($stmt = mysqli_prepare($conn,$sql))
	{
		$numCom = 0;
		mysqli_stmt_bind_param($stmt,'iisbs',$uid,$numCom,$title,$desc,$_FILES["pic"]["name"]);
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
	
	///////////////////////////////////////////////////////////////////////////////////////////
	if ($_FILES["pic"]["error"] > 0)
  	{
  		echo "Error: " . $_FILES["pic"]["error"] . "<br>";
  	}
  	else
  	{
  		if (!file_exists("C:\\xampp\\htdocs\\360\\images\\userimg\\".$_FILES["pic"]["name"]))
  		{
  			move_uploaded_file($_FILES["pic"]["tmp_name"], "C:\\xampp\\htdocs\\360\\images\\userimg\\".$_FILES["pic"]["name"]);
  		}
		
	}
	
	header("Location: viewPost.php?pid=$postId"); 
?>