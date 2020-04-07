<?php 
    
    $header = "Location: main.php";

    session_start();
    
    if (isset($_SESSION["loggedIn"]) && isset($_SESSION["uid"])) {
        
        $id = $_SESSION["uid"];
    
        $mysqli = new mysqli("localhost", "root","", "test");
        
        if($mysqli -> connect_errno){
            die("Connection failed: " . $mysqli->connect_error);
        }
        
        if($_SERVER["REQUEST_METHOD"]=="POST") {

            if (isset($_POST["firstname"])) {
                
                if ($_POST["firstname"] != "" && $_POST["firstname"] != null) {
               
                    if ($stmt = $mysqli -> prepare("UPDATE users SET firstname = ? WHERE uid = ?")) {
                        
                        $stmt -> bind_param("ss",$_POST["firstname"], $id);
                        $stmt -> execute();
                        $stmt -> close();
                    }
                }
            }
        
            if (isset($_POST["lastname"])) {
                
                if ($_POST["lastname"] != "" && $_POST["lastname"] != null) {
                    
                    if ($stmt = $mysqli -> prepare("UPDATE users SET firstname = ? WHERE uid = ?")) {
                    
                        $stmt -> bind_param("ss",$_POST["lastname"], $id);
                        $stmt -> execute();
                        $stmt -> close();
                    }
                }
            }
        
            if (isset($_POST["password"])) {
                
                if ($_POST["password"] != "" && $_POST["password"] != null){
                
                    if ($stmt = $mysqli -> prepare("UPDATE users SET password = ? WHERE uid = ?")) {
                        
                        $stmt -> bind_param("ss",$_POST["password"], $id);
                        $stmt -> execute();
                        $stmt -> close();
                    } 
                }
            }
        } $mysqli -> close();
    
    } else {
        $header = "Location: login.html";
    }
    
    header($header);
    exit;

?>