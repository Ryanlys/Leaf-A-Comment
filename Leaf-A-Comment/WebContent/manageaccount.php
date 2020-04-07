<!DOCTYPE html>
<html>
<body>

<?php 

    $header = "";

    session_start();
    
    if (isset($_SESSION["loggedIn"]) && isset($_SESSION["uid"])) {
        
        $id = $_SESSION["uid"];
        $log = $_SESSION["loggedIn"];
        
        if ($log){
    
    $mysqli = new mysqli("localhost", "root","", "test");
    
    if($mysqli -> connect_errno){
        die("Connection failed: " . $mysqli->connect_error);
    } 
    
    $username = $_REQUEST["username"];
    $email = $_REQUEST["email"];
    $oldpassword = $_REQUEST["oldpassword"];
    $newpassword = $_REQUEST["newpassword"];
    
    $exist=false;
    $verified=true;
    
    if ($stmt = $mysqli -> prepare("SELECT password FROM users WHERE uid = ?")){
        $stmt -> bind_param("s",$id);
        $stmt -> execute();
        while ($fieldinfo = $result -> fetch_assoc()){
            $x = $fieldinfo["password"];
            if (!($x == $oldpassword))
                //do something to form
                $verified = false;
        }
        $stmt -> close();
    }
    
        if ($username != "" && $username != null){
       
            if ($stmt = $mysqli -> prepare("UPDATE users SET username = ? WHERE uid = ?")){
                $stmt -> bind_param("ss",$username, $id);
                $stmt -> execute();
                $stmt -> close();
            } //else
                //echo "didn't update username";
        }
        
        if ($email != "" && $email != null){
            
            if ($stmt = $mysqli -> prepare("UPDATE users SET email = ? WHERE uid = ?")){
                $stmt -> bind_param("ss",$email, $id);
                $stmt -> execute();
                $stmt -> close();
            } //else
                //echo "didn't update email";
        }
       
        if ($newpassword != "" && $newpassword != null){
            
            if ($stmt = $mysqli -> prepare("UPDATE users SET password = ? WHERE uid = ?")){
                $stmt -> bind_param("ss",$newpassword, $id);
                $stmt -> execute();
                $stmt -> close();
            } //else
                //echo "didn't update password";
        }
    
    $mysqli -> close();
    $header = "Location: main.html";
    
        } } else {
        $header = "Location: login.html";
    }
    
    header($header);
    exit;

?>

</body>
</html>


