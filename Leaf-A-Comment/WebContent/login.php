<!DOCTYPE html>
<html>
<body>

<?php 

    session_start();
    
    $_SESSION["loggedIn"] = false;
    
    $mysqli = new mysqli("localhost", "root","", "test");
    
    if($mysqli -> connect_errno){
        die("Connection failed: " . $mysqli->connect_error);
    } 
    
    $username = "";
    $password= "";
    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        
        if (isset($_POST["username"]) && isset($_POST["password"])){
            $username = $_POST["username"];
            $password = $_POST["password"];
            
        }
    }
    
    $sql = "SELECT uid, username, password FROM users";
    
    $header="Location: main.html";
    
    if($result = $mysqli -> query($sql)){
        
        while($fieldinfo = $result -> fetch_assoc()){
            
            $a = $fieldinfo["username"];
            $b = $fieldinfo["password"];
            if (strcasecmp($a, $username)==0 && strcasecmp($b, $password)==0){
                $_SESSION["loggedIn"] = true;
                $_SESSION["uid"] = $fieldinfo["uid"];
                if ($_SESSION["uid"] == 1 || $_SESSION["uid"] == 3)
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
