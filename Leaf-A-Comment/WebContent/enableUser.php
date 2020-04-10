<?php
	session_start();

    $uid = $_REQUEST["uid"];

    $mysqli = new mysqli("localhost", "root","", "test");
    
    if($mysqli -> connect_errno){
        die("Connection failed: " . $mysqli->connect_error);
    } 
    
    $sql = "update users set enabled = 1 where uid = $uid";
    
    $mysqli -> query($sql);
    
    header("Location: adminIndex.php");
?>