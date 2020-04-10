<?php
	session_start();

    $p = $_REQUEST["pass"];
    $uid = $_REQUEST["uid"];

    $mysqli = new mysqli("localhost", "root","", "test");
    
    if($mysqli -> connect_errno){
        die("Connection failed: " . $mysqli->connect_error);
    } 
    
    $sql = "update users set password = $p where uid = $uid";
    
    $mysqli -> query($sql);
    unset($_SESSION["reset"]);
    header("Location: login.html");
?>