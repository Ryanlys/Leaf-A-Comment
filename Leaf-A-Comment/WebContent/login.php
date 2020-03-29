<!DOCTYPE html>
<html>
<body>

<?php 

    session_start();
    
    $_SESSION["loggedIn"] = false;
    
    $mysqli = new mysqli("localhost", "root","", "test");
    
    if($mysqli -> connect_errno){
        exit();
    } 
    
    $username = $_REQUEST["username"];
    $password = $_REQUEST["password"];
    
    $sql = "SELECT userid, username, password FROM users";
    $header="Location: main.html";
    
    if($result = $mysqli -> query($sql)){
        while($fieldinfo = $result -> fetch_field()){
            $a = $fieldinfo -> username;
            $b = $fieldinfo -> password;
            if ($a == $username && $b == password){
                $_SESSION["loggedIn"] = true;
                $_SESSION["uid"] = $fieldinfo -> userid;
                if ($_SESSION == 1 || $_SESSION == 3)
                    $_SESSION["admin"] = true;
            }
        }
        $result -> free_result();   
    }
    
    if ($_SESSION["loggedIn"] == false)
        $header = "Location: signup.html";
    
    $mysqli -> close();
    
    header($header);
    exit;
    

?>

</body>
</html>
