<?php
	session_start();

    $to = $_REQUEST["email"];
    echo $to;

    $mysqli = new mysqli("localhost", "root","", "test");
    
    if($mysqli -> connect_errno){
        die("Connection failed: " . $mysqli->connect_error);
    } 
    
    $sql = "SELECT * FROM users WHERE email = '$to';";
    
    if(!empty($result = $mysqli -> query($sql)))
    {
    	while($fieldinfo = $result -> fetch_assoc())
    	{		        
		        $a = $fieldinfo["uid"];
		        $_SESSION["reset"] = $a;
		};
        $txt = "You have an account with us, click <a href='http://localhost/360/resetpw.php?id=$a'> here </a> to reset your password";
    } else {
        $txt = "Sorry, we don't have you in our files, sign up <a href='http://localhost/360/signup.html'> here </a>!";
    }
    

    $subject = "Leaf A Comment: Password Recovery";
    $headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= "From: Admin <leafacomment@gmail.com>";
    
    if (mail($to,$subject,$txt,$headers)) {
       header("Location: main.php");
        exit;
    } else {
        //echo "ERROR";
        header("Location: main.php");
        exit;
    }

?>