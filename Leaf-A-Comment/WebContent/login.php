<!DOCTYPE html>
<html>
<body>

<?php 

    session_start();
    
    $_SESSION["loggedIn"] = false;
    $_SESSION["uid"] = false;
    
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
            }
        }
        $result -> free_result();   
        
        $sql = "SELECT uid FROM  admins";
        if($result = $mysqli -> query($sql)) {
            
            while($fieldinfo = $result -> fetch_assoc()) {
                
                $c = $fieldinfo["uid"];
                if ($_SESSION["uid"] == $c)
                    $_SESSION["admin"] = true;
            }
        }
    }
    
    if ($_SESSION["loggedIn"] == false)
        $header = "Location: signup.html";
        
    
    $mysqli -> close();
    
    header($header);
    exit;
    

?>

</body>
</html>
