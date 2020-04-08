<?php
    $to = $_REQUEST["email"];
    
    $mysqli = new mysqli("localhost", "root","", "test");
    
    if($mysqli -> connect_errno){
        die("Connection failed: " . $mysqli->connect_error);
    } 
    
    $sql = "SELECT * FROM users WHERE email = " . $to;
    
    if(!empty($result = $mysqli -> query($sql))){
        $txt = "You have an account with us, click here to reset your password";
    } else {
        $txt = "Sorry, we don't have you in our files, sign up here!";
    }
    
    $subject = "Leaf A Comment: Password Recovery";
    $headers = "From: Admin <leafacomment@gmail.com>";
    
    if (mail($to,$subject,$txt,$headers)) {
        header("Location: main.php");
        exit;
    } else {
        echo "ERROR";
    }

?>