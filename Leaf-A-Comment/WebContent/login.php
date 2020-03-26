
<!DOCTYPE html>
<html>
<body>

<?php 

    session_start();
    
    $mysqli = new mysqli("localhost", "root","", "test");
    
    if($mysqli -> connect_errno){
        exit();
    }
    
    $username = $_REQUEST["username"];
    $password = $_REQUEST["password"];
    $admin = false;
    
    $sql = "SELECT userid, username, password FROM users";
    
    if($result = $mysqli -> query($sql)){
        while($fieldinfo = $result -> fetch_field()){
            $a = $fieldinfo -> username;
            $b = $fieldinfo -> table;
            if ($a == $username && $b == password){
                $_SESSION["loggedIn"] = true;
                $c = $fieldinfo -> userid;
                if ($c == 1)
                    $admin = true;
            }
        }
        $result -> free_result();
        
    }

?>

</body>
</html>


