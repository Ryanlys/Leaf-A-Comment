<!DOCTYPE html>
<html>
<body>

<?php 

    session_start();
    
    $mysqli = new mysqli("localhost", "root","", "test");
    
    if($mysqli -> connect_errno){
        echo "error";
        exit();
    } else{
        echo "Connected! \n";
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
                echo $a + " " + $b;
                $c = $fieldinfo -> userid;
                if ($c == 1)
                    $admin = true;
            }
        }
        $result -> free_result();   
    } else{
        echo "Please signup!";
    }
    
    $sql -> close();
    $mysqli -> close();

?>

</body>
</html>
