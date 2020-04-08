<?php
    
    session_start();
    
    include "loggedin.php";
    
    $mysqli = new mysqli("localhost", "root","", "test");
    
    if($mysqli -> connect_errno){
        die("Connection failed: " . $mysqli->connect_error);
    } 
    
    if (isset($_GET["uid"])) {
        
        if ($stmt = $mysqli -> prepare("INSERT INTO admins VALUES (?)")){
            
            $stmt -> bind_param("i",$_GET["uid"]);
            $stmt -> execute();
            $stmt -> close();
            
        }
    }
    
    header("Location: adminIndex.php");
    exit;
    
	
?>

