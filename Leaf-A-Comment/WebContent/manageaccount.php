<!DOCTYPE html>
<html>
<body>

<?php 

    session_start();
    
    $id = $_SESSION["userid"];
    
    $mysqli = new mysqli("localhost", "root","", "test");
    
    if($mysqli -> connect_errno){
        echo "error";
        exit();
    } else{
        echo "Connected! \n";
    }
    
    $username = $_REQUEST["username"];
    $email = $_REQUEST["email"];
    $oldpassword = $_REQUEST["oldpassword"];
    $newpassword = $_REQUEST["newpassword"];
    
    $exist=false;
    $verified=true;
    
    if ($stmt = $mysqli -> prepare("SELECT password FROM users WHERE userid = ?")){
        $stmt -> bind_param("s",$id);
        $stmt -> execute();
        while ($fieldinfo = $result -> fetch_field()){
            $x = $fieldinfo -> password;
            if (!$x == $oldpassword)
                echo "wrong password";
                $verified = false;
        }
        $stmt -> close();
    } else
        echo ":(";
    
        if ($username != "" && $username != null){
       
            if ($stmt = $mysqli -> prepare("UPDATE users SET username = ? WHERE userid = ?")){
                $stmt -> bind_param("ss",$username, $id);
                $stmt -> execute();
                $stmt -> close();
            } else
                echo "didn't update username";
        }
        
        if ($email != "" && $email != null){
            
            if ($stmt = $mysqli -> prepare("UPDATE users SET email = ? WHERE userid = ?")){
                $stmt -> bind_param("ss",$email, $id);
                $stmt -> execute();
                $stmt -> close();
            } else
                echo "didn't update email";
        }
       
        if ($newpassword != "" && $newpassword != null){
            
            if ($stmt = $mysqli -> prepare("UPDATE users SET password = ? WHERE userid = ?")){
                $stmt -> bind_param("ss",$newpassword, $id);
                $stmt -> execute();
                $stmt -> close();
            } else
                echo "didn't update password";
        }
    
    $mysqli -> close();

?>

</body>
</html>


